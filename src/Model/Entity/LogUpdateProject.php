<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LogUpdateProject Entity
 *
 * @property int $id
 * @property int $m_user_id
 * @property int $order_id
 * @property string $bangou
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\MUser $m_user
 * @property \App\Model\Entity\Order $order
 */
class LogUpdateProject extends Entity
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
        'bangou' => true,
        'status' => true,
        'created' => true,
        'm_user' => true,
        'order' => true
    ];
}
