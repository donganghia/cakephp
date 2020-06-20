<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MSupplier Entity
 *
 * @property int $id
 * @property string $koudo
 * @property string $mei_1
 * @property string $mei_2
 * @property string $ryakushou
 * @property string $sakuin
 * @property string $yuubenbangou
 * @property string $juusho_1
 * @property string $juusho_2
 * @property string $juusho_3
 * @property string $kasutama_bakoudo
 * @property string $denwa
 * @property string $fax
 * @property int $m_system_shiiresaki_kategori_id
 * @property int $shiharai_saki_kubun
 * @property int $m_system_tantousha_id
 * @property string $aitesaki_tantousha_mei
 * @property string $bikou
 * @property string $email
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MUser[] $m_user
 */
class MSupplier extends Entity
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
        'koudo' => true,
        'mei_1' => true,
        'mei_2' => true,
        'ryakushou' => true,
        'sakuin' => true,
        'yuubenbangou' => true,
        'juusho_1' => true,
        'juusho_2' => true,
        'juusho_3' => true,
        'kasutama_bakoudo' => true,
        'denwa' => true,
        'fax' => true,
        'm_system_shiiresaki_kategori_id' => true,
        'shiharai_saki_kubun' => true,
        'area' => true,
        'm_system_tantousha_id' => true,
        'hiire_tanka_settei_kubun' => true,
        'tantousha_mei' => true,
        'bikou' => true,
        'email' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'm_user' => true
    ];
}
