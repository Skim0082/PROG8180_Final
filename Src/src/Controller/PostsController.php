<?php
// src/Controller/PostsController.php

namespace App\Controller;

use App\Controller\UsersController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class PostsController extends AppController{

    public $paginate = [
        'Posts' => [],
        'Users' => [],
        'Comments' => [],
        'order' => [
            'Posts.completed' => 'desc',
            'Posts.departureDate' => 'asc',
        ]
    ];
    
    
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }
    
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['index', 'view']);
        
  //      $this->Cookie->configKey('lastview', 'path', '/');
//        $this->Cookie->configKey('lastview', ['encryption'=>false, 'httpOnly' => false]);
    }
    
    public function afterSave(Event $event)
    {
        parent::afterSave($event);
    }
    
    public function index($id = null)
    {
        $this->paginate = [
        'contain' => ['Users', 'Comments']
        ];
        
        $loginuser = $this->Auth->user();
        
        if ($id == null) {
            $Posts = $this->Posts->find('all')
                                ->contain(['Users', 'Comments', 'UnapprovedComments', 'ApprovedComments'])
                                ->order(['departureDate' => 'ASC', 'departureTime' => 'ASC'])
                                ->where(['completed' => 0]);
         } else if ($id == 'comment') {
            $Posts = $this->Posts->find('all')
                                ->contain(['Users', 'Comments', 'UnapprovedComments', 'ApprovedComments'])
                                ->order(['completed' => 'ASC','departureDate' => 'ASC', 'departureTime' => 'ASC']);
            $Posts->matching('Comments', function ($q) {
                return $q->where(['Comments.user_id' => $this->request->session()->read('Auth.User.id')]);
            });
            
        } else if (($id == 0) && ($loginuser['role'] == 'admin')) {
            $Posts = $this->Posts->find('all')
                                ->contain(['Users', 'Comments', 'UnapprovedComments', 'ApprovedComments'])
                                ->order(['completed' => 'ASC','departureDate' => 'ASC', 'departureTime' => 'ASC']);
        } else {
            $Posts = $this->Posts->find('all')
                                ->contain(['Users', 'Comments', 'UnapprovedComments', 'ApprovedComments'])
                                ->order(['departureDate' => 'ASC', 'departureTime' => 'ASC'])
                                ->where(['user_id' => $loginuser['id']]);
        }
        
        $this->set('Posts', $this->paginate($Posts));
		$this->set('loginuser', $loginuser);
        $this->set('mode', $id);
    }
    
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
			'contain' => ['Comments', 'UnapprovedComments', 'ApprovedComments', 'Users']
		]);
        $this->set(compact('post'));
		
		$user = $this->Posts->Users->get($post->user_id);
		$this->set(compact('user'));
        
		$userlist = $this->Posts->Users->find('list',['keyField' => 'id',
                            'valueField' => 'nickname'])
                      ->toArray();
        
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser','userlist'));

    }	

    public function map()
    {
    	$map = "map";
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));  

		$data = [];
		
		if ($this->request->is('post')) {

			$data = [
				'From' => $this->request->data['From'],
				'To' => $this->request->data['To'],
				'Map' => $this->request->data['Map'],
				'KeyWord' => $this->request->data['KeyWord']
			];
			
			$this->set('result', $data);	
		} 
		//debug($data); 	
    }
	
    public function add()
    {
        $post = $this->Posts->newEntity();
		
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->data);
            if ($this->Auth->user('id') != null) {
                $post->user_id = $this->Auth->user('id');
            }

            if ($this->Posts->save($post)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add your post.'));
            }
        }
        $this->set('post', $post);
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));		
    }	
    
	public function edit($id = null)
	{
        return $this->redirect($this->referer());
		$post = $this->Posts->get($id,[
			'contain' => ['Comments', 'UnapprovedComments', 'ApprovedComments']
		]);
		
		if ($this->request->is(['post', 'put'])) {
			
			$this->Posts->patchEntity($post, $this->request->data, [
				'associated' => [
					'Tags',
					'Comments',
					'UnapprovedComments'
				]
			]);
			
			if ($this->Posts->save($post)) {
				$this->Flash->success(__('Your post has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update your post.'));
		}

		$this->set('post', $post);
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));		
	}	
    
    public function finish($id = null)
    {
        if ($id != null) {
            $post = $this->Posts->get($id);
            $post -> completed = 1;
            $post -> seatsAvailable = 0;
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('Thank you! You can find your post at my Posted List'));
                return $this->redirect(['controller'=>'Posts','action' => 'index']);
            } else {
                $this->Flash->error(__('The post could not be closed. Please, try again.'));
            }
        } else {
            $this->Flash->error(__('Unable to process your request.'));
        }
        
    }
    
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$post = $this->Posts->get($id);
		if ($this->Posts->delete($post)) {
			$this->Flash->success(__('The post with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
		}
	}

	public function isAuthorized($user)
	{
		// All registered users can add Posts
		if ($this->request->action === 'add') {
			return true;
		}

		// The owner of an post can edit and delete it
		if (in_array($this->request->action, ['edit', 'delete', 'finish'])) {
			$id = (int)$this->request->params['pass'][0];
			if ($this->Posts->isOwnedBy($id, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}	
	
}