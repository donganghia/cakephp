<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MSupplierProduct Entity
 *
 * @property int $id
 * @property int $m_supplier_id
 * @property int $tanka_masuta_kubun
 * @property int $tanka_shurui
 * @property string $shouhin_koudo
 * @property string $shouhin_mei
 * @property string $bunrui_koudo
 * @property int $tanka_shubetsu
 * @property int $tanka
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MSupplier $m_supplier
 * @property \App\Model\Entity\MSystemShiiretankaTorihikisaki $m_system_shiiretanka_torihikisaki
 */
class MSupplierProduct extends Entity
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
        'm_supplier_id' => true,
        'shouhin_koudo' => true,
        'bunrui_koudo' => true,
        'tanka_masuta_kubun' => true,
        'tanka_shurui' => true,
        'shouhin_koudo' => true,
        'shouhin_mei' => true,
        'tanka_shubetsu' => true,
        'tanka' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'm_supplier' => true
    ];
}
