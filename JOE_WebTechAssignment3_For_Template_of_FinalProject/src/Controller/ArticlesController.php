<?php
// src/Controller/ArticlesController.php

namespace App\Controller;

class ArticlesController extends AppController{

    public function index()
    {
        $articles = $this->Articles->find('all')->contain(['Authors', 'Comments', 'UnapprovedComments', 'Tags']);
        $this->set(compact('articles'));
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));
    }
    public function view($id = null)
    {
        $article = $this->Articles->get($id, [
			'contain' => ['Comments', 'UnapprovedComments', 'Tags']
		]);
        $this->set(compact('article'));
		
		$user = $this->Articles->Authors->get($article->user_id);
		$this->set(compact('user'));
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));
    }	
	
    public function add()
    {
        $article = $this->Articles->newEntity();
		
        if ($this->request->is('post')) {

			$data = [
				'title' => $this->request->data['title'],
				'body' => $this->request->data['body'],
				'user_id' => $this->Auth->user('id'),
				'tags' => [
					'_ids'=>$this->request->data['tags']
				]
			];	
			
            $article = $this->Articles->patchEntity($article, $data,[
				'associated' => ['Tags' => ['validate' => false]]
			]);		

			// Added this line
			//$article->user_id = $this->Auth->user('id');
			// You could also do the following
			//$newData = ['user_id' => $this->Auth->user('id')];
			//$article = $this->Articles->patchEntity($article, $newData);
		
            if ($this->Articles->save($article)) {
                $this->Flash->success(__('Your article has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your article.'));
        }
        $this->set('article', $article);
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));		
    }	
	public function edit($id = null)
	{
		$article = $this->Articles->get($id, [
			'contain' => ['Comments', 'UnapprovedComments', 'Tags']
		]);
		
		if ($this->request->is(['post', 'put'])) {
			
			$this->Articles->patchEntity($article, $this->request->data, [
				'associated' => [
					'Tags',
					'Comments',
					'UnapprovedComments'
				]
			]);
			
			if ($this->Articles->save($article)) {
				$this->Flash->success(__('Your article has been updated.'));
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->error(__('Unable to update your article.'));
		}

		$this->set('article', $article);
		
		$loginuser = $this->Auth->user();
		$this->set(compact('loginuser'));		
	}	
	public function delete($id)
	{
		$this->request->allowMethod(['post', 'delete']);

		$article = $this->Articles->get($id);
		if ($this->Articles->delete($article)) {
			$this->Flash->success(__('The article with id: {0} has been deleted.', h($id)));
			return $this->redirect(['action' => 'index']);
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
			$articleId = (int)$this->request->params['pass'][0];
			if ($this->Articles->isOwnedBy($articleId, $user['id'])) {
				return true;
			}
		}

		return parent::isAuthorized($user);
	}	
	
}