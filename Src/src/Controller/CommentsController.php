<?php
// src/Controller/CommentsController.php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

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
                $this->loadModel('Posts');
                $post = $this->Posts->get($comment->post_id, ['contain' => ['Users']]);
                $this->commentmail($id, $post->user['nickname'], $post->user['email']);
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
			return $this->redirect($this->referer());
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
            'contain' => ['Posts', 'Users']
        ]);
        
        //This is to block unauthorized user from apporving comment.
        //isAuthorized() can be also candiadate, but this implmentation can be more efficient
        if ($comment -> post['user_id'] != $this->Auth->user('id')) {
            $this->Flash->error(__('You are not authorized to do this operation'));
            return $this->redirect(['controller'=>'Posts','action' => 'index']);
        }
        
        $comment->approved = 1;

        if ($this->Comments->save($comment)) {
            $this->Flash->success(__('The comment has been approved.'));
             
            $this->approvalmail($comment->post_id, $comment->user['nickname'], $comment->user['email']);

            return $this->redirect(['controller'=>'Posts','action' => 'index']);
        } else {
            $this->Flash->error(__('The comment could not be approved. Please, try again.'));
        }
    }
    
    
    public function approvalmail($id, $nickname, $email)
    {
        $subject = "Post ID:".$id."  Approval of your comment";
        $mailText = "Hello ".$nickname.", \r\n".
            "Your comment is approved\r\n\r\nYou can view your messgae with following link\r\n".
            "http://cocors.herokuapp.com/posts/view/".$id;
        self::sendmail($id, $email, $subject, $mailText);
    }
    
    public function commentmail($id, $nickname, $email)
    {
        $subject = "Post ID:".$id."Updated for your comment or post";
        $mailText = "Hello ".$nickname.", \r\n".
            "New comments added\r\n\r\nYou can view your messgae with following link\r\n".
            "http://cocors.herokuapp.com/posts/view/".$id;
        self::sendmail($id, $email, $subject, $mailText);
    }
    
    public function sendmail($id, $email, $subject, $mailText)
    {  
        
        $mail = "mail";
        $loginuser = $this->Auth->user();
        $data = [];

        $data = [
            'mailFrom' => 'cchoi1803@conestogac.on.ca',
            'email' => $email,
            'mailSubject' => $subject,
            'mailText' => $mailText
        ];

        $email = new Email('default');
        $email->from(['cchoi1803@conestogac.on.ca' => 'COCORS Site']);
        $email->to($data['email']);
        $email->subject($data['mailSubject']); 
        $email->send($data['mailText']); 

        $this->set('result', $data);    
    }
    
    
	public function isAuthorized($user)
	{
		// All registered users can add Posts
		if (in_array($this->request->action,['add','approve'])) {
			return true;
		}

		// The owner of an article can edit and delete it
		if (in_array($this->request->action, ['edit', 'delete'])) {
			$commentId = (int)$this->request->params['pass'][0];
            if ($this->Comments->isOwnedBy($commentId, $user['id'])) {
				return true;
			}
		}
        
		return parent::isAuthorized($user);
	}	
	
}