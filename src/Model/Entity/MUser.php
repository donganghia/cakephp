<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MUser Entity
 *
 * @property int $id
 * @property int $m_role_id
 * @property int $m_supplier_id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $type
 * @property bool $is_active
 * @property bool $is_mail_manga
 * @property \Cake\I18n\FrozenTime $last_login
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MRole $m_role
 * @property \App\Model\Entity\MSupplier $m_supplier
 */
class MUser extends Entity
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
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
}
