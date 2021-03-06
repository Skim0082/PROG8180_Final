<?php
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
    
class AppController extends Controller
{
    public function map() {
    $this->helpers[] = 'Tools.GoogleMapHelper';
    // rest of your code       
    }

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
			'authorize' => ['Controller'],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'email', 'password' => 'password']
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'display'
            ],
            'logoutRedirect' => [
                'controller' => 'Pages',
                'action' => 'display'
            ]
        ]);   
    }
	public function isAuthorized($user)
	{
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'admin') {
			return true;
		}
		// Default deny
		return false;
	}	
	
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index', 'view', 'display','map']);
    }
	
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
    */
    /*
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
    */	
}
