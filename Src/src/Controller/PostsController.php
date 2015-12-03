<?php
// src/Controller/PostsController.php

namespace App\Controller;

class PostsController extends AppController{
    
    public function index()
    {
        $Posts = $this->Posts->find('all')->contain(['Users', 'Comments', 'UnapprovedComments']);
        $this->set(compact('Posts'));
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));
    }
    
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
			'contain' => ['Comments', 'UnapprovedComments']
		]);
        $this->set(compact('post'));
		
		$user = $this->Posts->Users->get($post->id);
		$this->set(compact('user'));
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));
    }	
	
    public function add()
    {
        $post = $this->Posts->newEntity();
		
        if ($this->request->is('post')) {
			$this->request->data['user_id'] = $this->Auth->user('id');
		    $post = $this->Posts->patchEntity($post, $this->request->data);
            
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
        $this->set('post', $post);
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));		
    }	
	public function edit($id = null)
	{
		$post = $this->Posts->get($id, [
			'contain' => ['Comments', 'UnapprovedComments']
		]);
		
		if ($this->request->is(['post', 'put'])) {
			
			$this->Posts->patchEntity($post, $this->request->data, [
				'associated' => [
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
		if (in_array($this->request->action, ['edit', 'delete'])) {
			$id = (int)$this->request->params['pass'][0];
			if ($this->Posts->isOwnedBy($id, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}	
	
}