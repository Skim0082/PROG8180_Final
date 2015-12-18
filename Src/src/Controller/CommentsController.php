<?php
// src/Controller/CommentsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class CommentsController extends AppController
{

    public function add($id = null)
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->data);			
			$comment->post_id = $id;
            $comment->user_id = $this->Auth->user('id');

            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Unable to add comments.'));
            }
        }
        $this->set('comment', $comment);
    }
	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$comment = $this->Comments->get($id);
		if ($this->Comments->delete($comment)) {
			$this->Flash->success(__('The comment with id: {0} has been deleted.', h($id)));
			return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
		}
	}	

    /**
     * Approve method
     *
     * @param string|null $id Comment id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function approve($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Posts']
        ]);
        $comment->approved = 1;
        
        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('The comment has been approved.'));
            return $this->redirect(['controller'=>'Posts','action' => 'index']);
        } else {
            $this->Flash->error(__('The comment could not be approved. Please, try again.'));
        }
    }
    
	public function isAuthorized($user)
	{
		// All registered users can add Posts
		if ($this->request->action === 'add') {
			return true;
		}

		// The owner of an article can edit and delete it
		if (in_array($this->request->action, ['edit', 'delete'])) {
			$commentId = (int)$this->request->params['pass'][0];
			return true;
		}

		return parent::isAuthorized($user);
	}	
	
}