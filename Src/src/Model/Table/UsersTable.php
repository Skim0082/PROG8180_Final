<?php
// src/Model/Table/UsersTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\RulesChecker;

class UsersTable extends Table
{
	public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('email', 'valid', ['rule' => 'email'])
            ->requirePresence('email', 'create')
            ->notEmpty('email')
            ->add('email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('password', 'create')
            ->notEmpty('password'); 
        
        $validator
            ->requirePresence('lastname', 'create')
            ->notEmpty('lastname');
        
        $validator
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');
        
        $validator
            ->requirePresence('firstname', 'create')
            ->notEmpty('firstname');
        
        $validator
            ->requirePresence('nickname', 'create')
            ->notEmpty('nickname');
       
        $validator
            ->requirePresence('role', 'create')
         ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'user']],
                'message' => 'Please enter a valid role'
            ]);
        
        return $validator;
    }
    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['id'], 'Users'));
        return $rules;
    }
    public function isOwnedBy($requestedId, $loginId)
    {
        return (bool)($requestedId == $loginId);
    }
}