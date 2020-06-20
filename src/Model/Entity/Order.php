<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $project_id
 * @property int $m_system_tantou_id
 * @property int $m_system_joutaikubun_id
 * @property int $m_system_ankenkoudo_id
 * @property int $shoukaisha_id
 * @property string $bangou
 * @property string $juchuu_bangou
 * @property \Cake\I18n\FrozenTime $tourokubi
 * @property int $torihiki
 * @property \Cake\I18n\FrozenDate $keiyaku_yotei_jiki
 * @property \Cake\I18n\FrozenDate $nouki_kaishibi
 * @property \Cake\I18n\FrozenDate $nouki_shuuryoubi
 * @property \Cake\I18n\FrozenDate $kibou_nouki_kaishi
 * @property \Cake\I18n\FrozenDate $kibou_nouki_shuuryou
 * @property int $status
 * @property int $shori_joukyou
 * @property string $shori_jiyuu
 * @property bool $seikan
 * @property int $user_created
 * @property int $last_user_modified
 * @property int $hatchuu_tanka_goukei
 * @property int $hatchuu_kingaku_goukei
 * @property int $juchuu_kingaku_goukei
 * @property int $juchuu_shouhizei
 * @property int $juchuu_tanka_goukei
 * @property int $uriage_zumi_goukei
 * @property int $shouhizei
 * @property int $hanbai_kanrihi
 * @property int $hanbai_kanrihi_shouhizei
 * @property int $hanbai_kanrihi_shoukei
 * @property int $shussei_nebiki_zeinu_goukei
 * @property int $shussei_nebiki_shouhizei
 * @property int $shussei_nebiki_goukei
 * @property int $shussei_nebiki
 * @property int $saishuu_goukei
 * @property int $zeinu_rieki
 * @property int $rieki_ritsu
 * @property int $souzeinu_rieki
 * @property int $sourieki_ritsu
 * @property bool $hanbai_kanrihi_tsuika
 * @property bool $shussei_nebiki_tsuika
 * @property int $zeiritsu
 * @property int $seiyaku_kakudo
 * @property \Cake\I18n\FrozenTime $last_comment_date
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property \Cake\I18n\FrozenTime $deleted
 * @property \App\Model\Entity\Project $project
 * @property \App\Model\Entity\OrderAttachedFile[] $order_attached_file
 * @property \App\Model\Entity\OrderDetail[] $order_detail
 */
class Order extends Entity
{

    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
