<?php
// src/Model/Table/PostsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
		$this->belongsTo('Users', [
			'className'=>'Users',
			'foreignKey'=>'user_id'
		]);
		
		$this->hasMany('Comments', [
			'className' => 'Comments',
			'foreignKey' => 'post_id',
			'dependent' => true
		]);
		
        $this->hasMany('ApprovedComments', [
			'className' => 'Comments',
			'foreignKey' => 'post_id',
			'dependent' => true,			
			'conditions' => ['approved' => true],
            'propertyName' => 'approved_comments'
		]);	
        
		$this->hasMany('UnapprovedComments', [
			'className' => 'Comments',
			'foreignKey' => 'post_id',
			'dependent' => true,			
			'conditions' => ['approved' => false],
            'propertyName' => 'unapproved_comments'
		]);	
		
		$this->belongsToMany('Tags', [
			'joinTable' => 'poststags'
		]);
    }
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('postType')
            ->requirePresence('postType')
            ->notEmpty('preferredContact')
            ->requirePresence('preferredContact')
            ->notEmpty('seatsAvailable')
            ->requirePresence('seatsAvailable')
            ->notEmpty('costPerPerson')
            ->requirePresence('costPerPerson')
            ->notEmpty('departureDate')
            ->requirePresence('departureDate')
            ->notEmpty('departureTime')
            ->requirePresence('departureTime')
            ->notEmpty('srcAddr')
            ->requirePresence('srcAddr')
            ->notEmpty('dstAddr')
            ->requirePresence('dstAddr');

        return $validator;
    }
    
	public function isOwnedBy($postId, $userId)
	{
		return $this->exists(['id' => $postId, 'user_id' => $userId]);
	}	
}