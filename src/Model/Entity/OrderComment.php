<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderComment Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int $order_id
 * @property int $m_supplier_id
 * @property string $anken_koudo
 * @property string $juchuu_bangou
 * @property \Cake\I18n\FrozenTime $last_comment_date
 * @property int $last_user_modified
 * @property int $order_user_created
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Order $order
 */
class OrderComment extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
