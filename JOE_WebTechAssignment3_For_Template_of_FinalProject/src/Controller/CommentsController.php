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
			
			$comment->article_id = $id;
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('comment', $comment);
    }
	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$comment = $this->Comments->get($id);
		if ($this->Comments->delete($comment)) {
			$this->Flash->success(__('The comment with id: {0} has been deleted.', h($id)));
			return $this->redirect(['controller' => 'Articles', 'action' => 'index']);
		}
	}	

	public function isAuthorized($user)
	{
		// All registered users can add articles
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