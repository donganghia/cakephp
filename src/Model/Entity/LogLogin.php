<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LogLogin Entity
 *
 * @property int $id
 * @property int $m_user_id
 * @property string $m_supplier_name
 * @property string $ip_address
 * @property string $user_agent
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\MUser $m_user
 */
class LogLogin extends Entity
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
        'm_supplier_name' => true,
        'm_user_username' => true,
        'm_user_name' => true,
        'm_user_created' => true,
        'ip_address' => true,
        'user_agent' => true,
        'created' => true,
        'm_user' => true
    ];
}
