<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MCustomerHistory Entity
 *
 * @property int $id
 * @property int $m_customer_id
 * @property int $shubetsu
 * @property string $rireki_renban
 * @property string $smile_no
 * @property string $history_id
 * @property string $synergy_id
 * @property \Cake\I18n\FrozenDate $hidzuke
 * @property string $kanri_bangou
 * @property string $shimei
 * @property int $taitoru
 * @property string $irai_naiyou
 * @property string $taiou_naiyou
 * @property string $kureemu
 * @property int $taiou_gyousha
 * @property int $tantoushamei
 * @property string $bikou
 * @property string $hanbai_juchuu_bangou
 * @property \Cake\I18n\FrozenDate $sabisu_jisshibi
 * @property string $kureemu_naiyou_taiou
 * @property int $ankeeto_haifu
 * @property int $manzokudo
 * @property string $kakaku_manzokudo
 * @property string $sutaffu_nitsuite
 * @property string $sonota_iken
 * @property string $taiou_joukyou
 * @property string $yobi
 * @property \Cake\I18n\FrozenDate $uketsukebi
 * @property string $uketsuke_bangou
 * @property int $hanbai_kingaku
 * @property int $hatchuu_kingaku
 * @property int $rireki_tesuuryou
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MCustomer $m_customer
 * @property \App\Model\Entity\History $history
 * @property \App\Model\Entity\Synergy $synergy
 */
class MCustomerHistory extends Entity
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
}
