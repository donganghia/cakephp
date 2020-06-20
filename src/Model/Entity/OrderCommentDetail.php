<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderCommentDetail Entity
 *
 * @property int $id
 * @property int $m_user_id
 * @property int $order_comment_id
 * @property string $content
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\OrderComment $order_comment
 */
class OrderCommentDetail extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
