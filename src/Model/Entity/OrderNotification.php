<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderNotification Entity
 *
 * @property int $id
 * @property int $m_user_id
 * @property int $order_id
 * @property int $m_system_tantou_id
 * @property string $title
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\MSystemTantous $m_system_tantous
 */
class OrderNotification extends Entity
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
        'm_user_id' => true,
        'order_id' => true,
        'm_system_tantou_id' => true,
        'title' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'm_user' => true,
        'order' => true,
        'm_system_tantous' => true
    ];
}
