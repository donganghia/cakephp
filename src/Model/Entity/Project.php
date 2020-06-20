<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Project Entity
 *
 * @property int $id
 * @property int $m_system_kaiinshurui_id
 * @property int $m_system_tantousha_id
 * @property int $m_system_shiharaihouhou_id
 * @property int $m_system_bumon_id
 * @property int $m_system_kamoku_id
 * @property int $m_system_joutaikubun_id
 * @property int $m_mediation_gensen_id
 * @property int $m_customer_id
 * @property string $bangou
 * @property \Cake\I18n\FrozenDate $uriagebi
 * @property string $tokuisaki_koudo
 * @property \Cake\I18n\FrozenDate $kaiin_kaiyakubi
 * @property string $sagyouchi
 * @property string $teimei
 * @property int $gyou_bangou
 * @property int $ararigaku_goukei
 * @property int $uriage_yotei_goukei
 * @property int $uriage_zumi_goukei
 * @property string $shoukaisha_sonota_jouhou
 * @property int $shoukai_tesuuryou_umu
 * @property string $shoukai_tesuuryou_bikou
 * @property int $sekisui_chuumonsho_umu
 * @property \Cake\I18n\FrozenDate $sekisui_choumonsho_hidzuke
 * @property string $sekisui_choumonsho_bikou
 * @property int $sekisui_shiharaitsuuchisho_umu
 * @property \Cake\I18n\FrozenDate $sekisui_shiharaitsuuchisho_nyuukinbi
 * @property string $sekisui_shiharaitsuuchisho_bikou
 * @property string $e_moushisha_yuubenbangou
 * @property string $e_moushisha_juushotodoufuken
 * @property string $e_moushisha_juushoshichou
 * @property string $e_sabisukibou_yuubenbangou
 * @property string $e_sabisukibou_juushotodoufuken
 * @property string $e_sabisukibou_juushoshichou
 * @property string $e_sabisukibou_juushomanshonmei
 * @property bool $moushikomisha_douitsu
 * @property string $bikou
 * @property int $type
 * @property \Cake\I18n\FrozenDate $nouki_kaishibi
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 */
class Project extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
