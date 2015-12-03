<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ArticlesTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
		$this->belongsTo('Authors', [
			'className'=>'Users',
			'foreignKey'=>'user_id'
		]);
		
		$this->hasMany('Comments', [
			'className' => 'Comments',
			'foreignKey' => 'article_id',
			'dependent' => true,
			'conditions' => ['approved' => true]
		]);
		
		$this->hasMany('UnapprovedComments', [
			'className' => 'Comments',
			'foreignKey' => 'article_id',
			'dependent' => true,			
			'conditions' => ['approved' => false],
            'propertyName' => 'unapproved_comments'
		]);	
		
		$this->belongsToMany('Tags', [
			'joinTable' => 'articles_tags'
		]);
    }
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title')
            ->requirePresence('title')
            ->notEmpty('body')
            ->requirePresence('body');

        return $validator;
    }
	public function isOwnedBy($articleId, $userId)
	{
		return $this->exists(['id' => $articleId, 'user_id' => $userId]);
	}	
}