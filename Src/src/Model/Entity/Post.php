<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Post Entity.
 *
 * @property int $post_id
 * @property \App\Model\Entity\Post $post
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property string $body
 * @property int $approved
 * @property \Cake\I18n\Time $modifed
 * @property \Cake\I18n\Time $created
 * @property int $id
 */
class Post extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'completed' => false,
    ];
}