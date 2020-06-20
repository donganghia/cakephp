<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MCustomer Entity
 *
 * @property int $id
 * @property string $smile_bangou
 * @property string $kanri_bangou
 * @property string $kanri_bangou2
 * @property string $yuutai_sabisupasuwado
 * @property string $synergry_id
 * @property string $kaiin_bangou
 * @property string $memo
 * @property string $web_moushikomi_uketsuke_bangou
 * @property \Cake\I18n\FrozenTime $shokai_touroku_taimu_sutanpu
 * @property string $okyaku_sama_bangou
 * @property string $nittei
 * @property \Cake\I18n\FrozenDate $shuhensaishin_sekou_yoteibi
 * @property \Cake\I18n\FrozenDate $fukakachi_sabisukaishi_yoteibi
 * @property string $henkou_gokeiyaku_shubetsu_koudo
 * @property string $henkou_gojukyu_keiyaku_opushon_koudo
 * @property string $moushikomi_shubetsu_kubun
 * @property string $moushikomi_shasonota_renraku_jikou
 * @property string $saishin_kubun
 * @property string $gokeiyaku_meigi_kanji
 * @property string $gokeiyaku_meigi_kana
 * @property string $juyoubasho_youbinbangou
 * @property string $juyoubasho_todoufukenmei
 * @property string $juyoubasho_shikuchousonmei
 * @property string $juyoubasho_tatemono_banchi
 * @property string $juyoubasho_tatemono_mei
 * @property string $juyoubasho_tougousuu
 * @property string $juyoubasho_denwabangou_shurui
 * @property string $juyoubasho_denwabangou
 * @property string $moushisha_keiyaku_kankei_koudo
 * @property string $moushisha_bushomei_kanji
 * @property string $moushisha_moushimei_kanji
 * @property string $moushisha_moushimei_kana
 * @property string $moushisha_denwabangou_shurui
 * @property string $moushisha_denwabangou
 * @property string $joukiigai_denwabangou
 * @property string $genjousho_tenwabangou
 * @property string $moushisha_fakkusu
 * @property string $moushisha_kinkyou_renrakusen_denwabangou_shurui
 * @property string $moushisha_kinkyou_renrakusen_denwabangou
 * @property string $moushisha_meiru
 * @property string $keitai_meiru
 * @property \Cake\I18n\FrozenDate $e_moushisha_seinengappi
 * @property string $e_sabisu_kibou_juusho_shurui
 * @property string $e_moushisha_youbinbangou
 * @property string $e_moushisha_juusho_todoufuken
 * @property string $e_moushisha_juusho_shikuchousonikou
 * @property string $e_moushisha_juusho_manshon_mei
 * @property string $e_meiru_megajin_aishinfuragu
 * @property string $e_sabisu_kibou_youbinbangou
 * @property string $e_sabisu_kibou_juusho_todoufuken
 * @property string $e_sabisu_kibou_juusho_shikuchousonikou
 * @property string $e_sabisu_kibou_juusho_manshon_mei
 * @property string $meirumegajin_meiru
 * @property int $meirumegajin_haishin
 * @property string $tokui_saki_mei1
 * @property string $tokui_saki_mei2
 * @property string $tokui_saki_ryakushou
 * @property string $tokui_saki_kana
 * @property string $yuubenbangou
 * @property string $juusho1_todoufuken_mei
 * @property string $juusho2_shiku_chouson_banchi
 * @property string $juusho3_tatemono_mei
 * @property string $denwa
 * @property string $keitai_bangou
 * @property string $fakkusu_bangou
 * @property int $e_doukyo_hitokazoku
 * @property string $doukyo_kazoku1_shimei
 * @property string $doukyo_kazoku1_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku1_seinengappi
 * @property string $doukyo_kazoku2_shimei
 * @property string $doukyo_kazoku2_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku2_seinengappi
 * @property string $doukyo_kazoku3_shimei
 * @property string $doukyo_kazoku3_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku3_seinengappi
 * @property string $doukyo_kazoku4_shimei
 * @property string $doukyo_kazoku4_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku4_seinengappi
 * @property string $doukyo_kazoku5_shimei
 * @property string $doukyo_kazoku5_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku5_seinengappi
 * @property string $doukyo_kazoku6_shimei
 * @property string $doukyo_kazoku6_furigana
 * @property \Cake\I18n\FrozenDate $doukyo_kazoku6_seinengappi
 * @property string $e_touroku_chekku_ran
 * @property string $e_chekku_rankinyuushaid_mei
 * @property string $e_chekku_kinyou_jikan
 * @property string $kigyou_dantai_koudo
 * @property string $nikkunemu
 * @property string $pasuwado
 * @property string $seibetsu
 * @property bool $chintai
 * @property string $chingarinin
 * @property \Cake\I18n\FrozenDate $moushibi
 * @property \Cake\I18n\FrozenDate $kaiin_tourokubi
 * @property string $kaiyaku
 * @property \Cake\I18n\FrozenDate $kaiyaku_uketsukebi
 * @property \Cake\I18n\FrozenDate $kaiyaku_shosoufubi
 * @property \Cake\I18n\FrozenDate $kaiin_kaiyakubi
 * @property string $jbr_kaiyaku_tsuchi
 * @property int $shoudakusho_juryou_joukyou
 * @property \Cake\I18n\FrozenDate $sabisu_kaishibi
 * @property string $koushin_kakunin_furagu
 * @property \Cake\I18n\FrozenDate $jikaikouzafurikae_yoteibi
 * @property \Cake\I18n\FrozenDate $gmo_koushin_yoteibi
 * @property int $m_system_kaiinshurui_id
 * @property int $m_system_bukkenkubun_id
 * @property int $m_system_kyojuueria_id
 * @property int $m_system_shonendo_nenkaihi_id
 * @property int $m_system_kaihikubun_id
 * @property int $m_system_juotakumeika_id
 * @property int $m_system_manshonmei_id
 * @property int $m_system_shiten_id
 * @property int $m_system_kihonsyubetu_id
 * @property int $m_system_kaiinenji_id
 * @property int $m_system_tantousha_id
 * @property int $m_system_sabisukubun_id
 * @property int $m_mediation_gensen_id
 * @property string $eigyou_tantou
 * @property string $sanyou_houmuzu_seiban
 * @property \Cake\I18n\FrozenDate $hikiwatashi_nengappi
 * @property string $gensen
 * @property string $kyuujuusho_youbinbangou
 * @property string $kyuujuusho_todoufukenmei
 * @property string $kyuujuusho_shikuchousonbanchi
 * @property string $kyuujuusho_tatemonomeita
 * @property string $kaiin_shurui_mojigata
 * @property string $kouza_furikae_kubun
 * @property string $kinyuukkan_meishou
 * @property string $kinyuukkan_koudo
 * @property string $honshiten_shutchoujo_meishou
 * @property string $honshiten_shutchoujo_koudo
 * @property string $yuucho_ginkou_tsuochou_kigou
 * @property int $shingaisha_shoudakusho_soufu
 * @property int $shoudakusho_henshin
 * @property int $sabisu_manki_tsuki
 * @property bool $kuuringuofu_tsuuchi
 * @property string $bikou
 * @property int $active_tab
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 *
 * @property \App\Model\Entity\MMediation $m_mediation
 */
class MCustomer extends Entity
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
