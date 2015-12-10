<?php
// src/Controller/UsersController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Validation\Validation;

define('FACEBOOK_SDK_V4_SRC_DIR','../Vendor/fb/src/Facebook/');
require_once("../Vendor/fb/autoload.php");

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;
use Facebook\FacebookCanvasLoginHelper;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
		// Allow users to register and logout.
		// You should not add the "login" action to allow list. Doing so would
		// cause problems with normal functioning of AuthComponent.
		$this->Auth->allow(['add', 'logout', 'facebook']);
        parent::beforeFilter($event);
    }

    public function profile($id = null)
    {
        if($id == null){
            $user = $this->Auth->user();
        }else{
            $user = $this->Users->get($id);
        }
        $this->set('user', $user);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id);
        
        if ($this->request->is(['put'])) {
            
            $this->Users->patchEntity($user, $this->request->data);
            
            if ($this->Users->save($user)) {

                //after edit of users, update the infor to Auth component
                $this->Auth->setUser($user->toArray());

                $this->Flash->success(__('Your profile has been updated.'));
                return $this->redirect(['controller' => 'Users', 'action' => 'profile', $user->id]);
            }
            $this->Flash->error(__('Unable to update your profile.'));
        }
        $this->set('user', $user);      
    }    
	
	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect($this->Auth->redirectUrl());
			}
			$this->Flash->error(__('Invalid username or password, try again'));
		}
	}

	public function logout()
	{
        $_SESSION = null;
        session_destroy();
		return $this->redirect($this->Auth->logout());
	}	

    public function index()
    {
        $this->set('users', $this->Users->find('all'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }

    /**
     * Facebook Login
     */
    public function facebook(){          

        $loginuser = $this->Auth->user();
        $this->set(compact('loginuser'));   

        FacebookSession::setDefaultApplication(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
        $helper = new FacebookJavaScriptLoginHelper();
        $session = $helper->getSession();
        //$output = $session->getUserId();

        if(isset($_SESSION['fb_token'])){
            $session = new FacebookSession($_SESSION['fb_token']);
            try{
                $session->validate(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
            }catch(FacebookAuthorizationException $e){
                echo $e->getMessage();
            }
        }

        $data = array();
        $fb_data = array();      

        if(isset($session)){

            $_SESSION['fb_token'] = $session->getToken();
            $request = new FacebookRequest($session, 'GET', '/me');
            $response = $request->execute();
            $graph = $response->getGraphObject(GraphUser::className());

            $fb_data = $graph->asArray();

            if(!empty($fb_data)){    

                $fb_data['email'] = $graph->getProperty('email');            

                //$result = $this->Users->findByEmail( $fb_data['email'] );
                $user = $this->Users->find()
                    ->where(['facebook_id'=> $fb_data['id']])
                    ->first();

                if(!empty($user)){

                    /*
                    $user = array(
                        'id' => $result['id'],
                        'username' => $result['username'], 
                        'password'=> $result['password'],
                        'role' => $result['role']
                        );
                    */

                    //if ($user) {

                        $this->Auth->setUser($user->toArray());
                        //$this->redirect(BASE_PATH.'articles/index');
                        return $this->redirect($this->Auth->redirectUrl());
                    //}                    

                }else{

                    $this->set('username', $fb_data['name']);
                    $user = $this->Users->newEntity();

                    if ($this->request->is(['post'])) {

                        $data = [
                            'username' => $fb_data['name'],
                            'facebook_id' => $fb_data['id'],
                            'email' => $fb_data['email'],
                            'password' => $this->request->data['password']
                        ];

                        $user = $this->Users->patchEntity($user, $data);

                        if($result = $this->Users->save( $user )){
                            
                            //login and set the Authentication for the sign up user
                            $this->request->data = ['username' => $data['username'], 'password'=>$data['password']];
                            $user = $this->Auth->identify();
                            $this->Auth->setUser($user);

                            $this->Flash->success(__('The user "'. $fb_data['name'] . '"" has been saved.'));
                            //$this->redirect(BASE_PATH.'articles/index');                        
                            return $this->redirect($this->Auth->redirectUrl());

                        }else{
                            $this->Flash->error(__('Unable to add the user.'));
                            $this->redirect(BASE_PATH.'users/login');
                        }
                    }
                }

            }else{
                $this->Flash->error(__('Unable to add the user.'));
                $this->redirect(BASE_PATH.'users/login');
            }
        }else{
            $this->set('username', "");
        }
        
    }

    public function isAuthorized($user)
    {
        // All registered users can add articles
        if (in_array($this->request->action, ['add'])){
            return true;
        }

        // Show the only owner profile of logined user.
        if (in_array($this->request->action, ['profile'])){
            if(empty($this->request->params['pass'])){
                return true;
            }else{
                $requestedId = $this->request->params['pass'][0];
                $loginedId = $this->Auth->user()['id'];

                if ($this->Users->isOwnedBy($requestedId, $loginedId)) {
                    return true;
                }                
            }
        }

        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {

            $requestedId = $this->request->params['pass'][0];
            $loginedId = $this->Auth->user()['id'];

            if ($this->Users->isOwnedBy($requestedId, $loginedId)) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }    
      
}