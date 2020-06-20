<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MProduct Entity
 *
 * @property int $id
 * @property string $koudo
 * @property string $mei
 * @property string $mei_sakuin
 * @property int $tani
 * @property int $setto_hinkubun
 * @property int $jidou_furikae_shori_taishou_kubun
 * @property int $zaiko_kanri_kubun
 * @property string $zaiko_kanri_kubun_mei
 * @property string $shu_shiiresaki_koudo
 * @property string $shu_shiiresaki_mei
 * @property int $hyoujun_uriage_tanka
 * @property int $tanka
 * @property int $hyoujun_shiire_tanka
 * @property int $zaiko_hyouka_tanka
 * @property int $arari_sanshutsu_you_tanka
 * @property int $joudai_tanka
 * @property int $shin_hyoujun_shiiretanka
 * @property int $shin_zaiko_hyouka_tanka
 * @property int $shin_arari_san_shutsuyou_tanka
 * @property int $shin_joudai_tanka
 * @property bool $bunrui_koudo
 * @property bool $kategori_id
 * @property int $hikazei_kubun
 * @property int $uriage_tanka_settei_kubun
 * @property int $shiiretanka_settei_kubun
 * @property int $shouhi_zeiritsu_kubun
 * @property int $kyu_zeiritsu
 * @property int $shin_zeiritsu
 * @property int $zeiritsu_jisshi_nengappi
 * @property int $ekisei_zaiko_suuryou
 * @property int $kishu_zan_suuryou
 * @property int $kishu_zan_kingaku
 * @property int $masuta_kensaku_hyouji_kubun
 * @property int $nyuryoku_patan_uriage_no
 * @property int $nyuryoku_patan_shiire_no
 * @property string $naiyou
 * @property \Cake\I18n\FrozenDate $keika_sochi_shiteibi
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\Kategori $kategori
 */
class MProduct extends Entity
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
        'edaban' => true,
        'm_supplier_id' => true,
        'm_supplier_product_id' => true,
        'shiiresaki_kazu' => true,
        'mei' => true,
        'mei_sakuin' => true,
        'tani' => true,
        'setto_hinkubun' => true,
        'jidou_furikae_shori_taishou_kubun' => true,
        'zaiko_kanri_kubun' => true,
        'tanka' => true,
        'ranku_1_uriage_tanka' => true,
        'hyoujun_shiire_tanka' => true,
        'hyoujun_uriage_tanka' => true,
        'm_system_shouhin_kategori_id' => true,
        'bunrui_koudo' => true,
        'kategori_id' => true,
        'hikazei_kubun' => true,
        'uriage_tanka_settei_kubun' => true,
        'shiiretanka_settei_kubun' => true,
        'kyu_zeiritsu' => true,
        'shin_zeiritsu' => true,
        'zeiritsu_jisshi_nengappi' => true,
        'ekisei_zaiko_suuryou' => true,
        'kishu_zan_suuryou' => true,
        'kishu_zan_kingaku' => true,
        'masuta_kensaku_hyouji_kubun' => true,
        'nyuryoku_patan_uriage_no' => true,
        'nyuryoku_patan_uriage_mei' => true,
        'nyuryoku_patan_shiire_no' => true,
        'nyuryoku_patan_shiire_mei' => true,
        'naiyou' => true,
        'keika_sochi_shiteibi' => true,
        'created' => true,
        'modified' => true,
        'deleted' => true,
        'kategori' => true
    ];
}
