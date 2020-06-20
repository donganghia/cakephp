<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrderDetail Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int $order_id
 * @property int $m_product_id
 * @property string $koudo
 * @property string $mei
 * @property int $m_supplier_id
 * @property int $m_system_joutaikubun_id
 * @property int $m_system_houmon_jikan_id
 * @property int $tani
 * @property string $hatchuu_bangou
 * @property int $suuryou
 * @property string $houmon_jikan_kaishi
 * @property string $houmon_jikan_shuuryou
 * @property \Cake\I18n\FrozenTime $nouki_kaishibi
 * @property \Cake\I18n\FrozenTime $nouki_shuuryoubi
 * @property int $kakunin_joutai
 * @property int $sagyou_kikan
 * @property int $hatchuu_tanka
 * @property int $hatchuu_kingaku
 * @property int $juchuu_tanka
 * @property int $juchuu_kingaku
 * @property int $shori_joukyou
 * @property string $shori_jiyuu
 * @property string $okyakusama_kakunin
 * @property int $henkou_taiou_umu
 * @property string $okyakusama_no_youbou
 * @property string $henkou_jiyuu
 * @property string $tokukijikou
 * @property int $keijou
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\MProduct $m_product
 * @property \App\Model\Entity\MSupplier $m_supplier
 */
class OrderDetail extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
