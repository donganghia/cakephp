<?php
namespace App\Model\Table;

use App\Libs\Message;
use App\Libs\Utility;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MCustomer Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKaiinshuruis
 * @property |\Cake\ORM\Association\BelongsTo $MSystemBukkenkubuns
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKyojuuerias
 * @property |\Cake\ORM\Association\BelongsTo $MSystemShonendoNenkaihis
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKaihikubuns
 * @property |\Cake\ORM\Association\BelongsTo $MSystemJuotakumeikas
 * @property |\Cake\ORM\Association\BelongsTo $MSystemManshonmeis
 * @property |\Cake\ORM\Association\BelongsTo $MSystemShitens
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKokyakuKihonsyubetus
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKokyakuKaiinenjis
 * @property |\Cake\ORM\Association\BelongsTo $MSystemTantoushas
 * @property |\Cake\ORM\Association\BelongsTo $MSystemSabisukubuns
 * @property |\Cake\ORM\Association\BelongsTo $MMediationGensens
 *
 * @method \App\Model\Entity\MCustomer get($primaryKey, $options = [])
 * @method \App\Model\Entity\MCustomer newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MCustomer[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MCustomer|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MCustomer|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MCustomer patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MCustomer[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MCustomer findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MCustomerTable extends BaseTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('m_customer');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        /*$this->belongsTo('MSystemKaiinshuruis', [
            'foreignKey' => 'm_system_kaiinshurui_id'
        ]);
        $this->belongsTo('MSystemBukkenkubuns', [
            'foreignKey' => 'm_system_bukkenkubun_id'
        ]);
        $this->belongsTo('MSystemKyojuuerias', [
            'foreignKey' => 'm_system_kyojuueria_id'
        ]);
        $this->belongsTo('MSystemShonendoNenkaihis', [
            'foreignKey' => 'm_system_shonendo_nenkaihi_id'
        ]);
        $this->belongsTo('MSystemKaihikubuns', [
            'foreignKey' => 'm_system_kaihikubun_id'
        ]);
        $this->belongsTo('MSystemJuotakumeikas', [
            'foreignKey' => 'm_system_juotakumeika_id'
        ]);
        $this->belongsTo('MSystemManshonmeis', [
            'foreignKey' => 'm_system_manshonmei_id'
        ]);
        $this->belongsTo('MSystemShitens', [
            'foreignKey' => 'm_system_shiten_id'
        ]);
        $this->belongsTo('MSystemKokyakuKihonsyubetus', [
            'foreignKey' => 'm_system_kihonsyubetu_id'
        ]);
        $this->belongsTo('MSystemKokyakuKaiinenjis', [
            'foreignKey' => 'm_system_kaiinenji_id'
        ]);
        $this->belongsTo('MSystemTantoushas', [
            'foreignKey' => 'm_system_tantousha_id'
        ]);
        $this->belongsTo('MSystemSabisukubuns', [
            'foreignKey' => 'm_system_sabisukubun_id'
        ]);
        $this->belongsTo('MMediationGensens', [
            'foreignKey' => 'm_mediation_gensen_id'
        ]);*/
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator->allowEmpty('id', 'create');

        $aryMaxLength20 = [
            'synergry_id' => 'SynergyID'
            ,'kanri_bangou2' => '# 管理番号'
        ];
        foreach ($aryMaxLength20 as $maxLengthKey => $maxLengthName) {
            $validator->allowEmpty($maxLengthKey)->add($maxLengthKey, [
                'maxLength' => [
                    'rule'    => ['maxLength', 20],
                    'message' => Utility::validMsg(Message::WITHIN, [$maxLengthName, '２０'])
                ]
            ]);
        }

        $aryMaxLength200 = [
            'yuutai_sabisupasuwado' => '優待Sパス'
            ,'moushisha_bushomei_kanji' => '申込者部署'
            ,'moushisha_denwabangou_shurui' => '申込者電話種類'
            ,'moushisha_denwabangou' => '申込者電話番号'
            ,'joukiigai_denwabangou' => '上記以外の電話番号'
            ,'genjousho_tenwabangou' => '現住所電話番号'
            ,'moushisha_fakkusu' => '申込者FAX番号'
            ,'moushisha_kinkyou_renrakusen_denwabangou_shurui' => '緊急連絡先電話種類'
            ,'moushisha_kinkyou_renrakusen_denwabangou' => '緊急連絡先電話番号'
            ,'moushisha_meiru' => '申込者メールアドレス'
            ,'keitai_meiru' => '携帯メールアドレス'
            //tab 2
            ,'e_moushisha_youbinbangou' => '申込者郵便番号'
            ,'e_moushisha_juusho_todoufuken' => '住所：都道府県名'
            ,'e_moushisha_juusho_shikuchousonikou' => '住所：市区町村番地'
            ,'e_moushisha_juusho_manshon_mei' => '住所：建物名他'
            ,'e_sabisu_kibou_juusho_shurui' => 'ｻｰﾋﾞｽ希望住所種類'
            ,'e_sabisu_kibou_youbinbangou' => 'ｻｰﾋﾞｽ希望郵便番号'
            ,'e_sabisu_kibou_juusho_manshon_mei' => 'ｻｰﾋﾞｽ希望 都道府県名'
            ,'e_sabisu_kibou_juusho_shikuchousonikou' => 'ｻｰﾋﾞｽ希望 市区町村番地'
            ,'e_sabisu_kibou_juusho_todoufuken' => 'ｻｰﾋﾞｽ希望 建物名他'
            ,'meirumegajin_meiru' => 'メールアドレス'
            ,'tokui_saki_mei1' => '得意先名1'
            ,'tokui_saki_mei2' => '得意先名2'
            ,'tokui_saki_ryakushou' => '得意先略称'
            ,'tokui_saki_kana' => 'カナ'
            ,'yuubenbangou' => '郵便番号'
            ,'juusho1_todoufuken_mei' => '住所1 都道府県名'
            ,'juusho2_shiku_chouson_banchi' => '住所2 市区町村番地'
            ,'juusho3_tatemono_mei' => '住所3 建物名他'
            ,'denwa' => '電話番号'
            ,'keitai_bangou' => '携帯番号'
            ,'fakkusu_bangou' => 'FAX番号'
            //tab 3
            ,'doukyo_kazoku1_shimei' => '（1）同居家族氏名'
            ,'doukyo_kazoku1_furigana' => '（1）同居家族カナ'
            ,'doukyo_kazoku2_shimei' => '（2）同居家族氏名'
            ,'doukyo_kazoku2_furigana' => '（2）同居家族カナ'
            ,'doukyo_kazoku3_shimei' => '（3）同居家族氏名'
            ,'doukyo_kazoku3_furigana' => '（3）同居家族カナ'
            ,'doukyo_kazoku4_shimei' => '（4）同居家族氏名'
            ,'doukyo_kazoku4_furigana' => '（4）同居家族カナ'
            ,'doukyo_kazoku5_shimei' => '（5）同居家族氏名'
            ,'doukyo_kazoku5_furigana' => '（5）同居家族カナ'
            ,'doukyo_kazoku6_shimei' => '（6）同居家族氏名'
            ,'doukyo_kazoku6_furigana' => '（6）同居家族カナ'
            //tab 4
            ,'web_moushikomi_uketsuke_bangou' => 'Web申込受付番号'
            ,'shokai_touroku_taimu_sutanpu' => 'Web申込受付番号'
            ,'okyaku_sama_bangou' => 'お客様番号'
            ,'nittei' => '日程'
            //tab 5
            //tab 6
        ];

        foreach ($aryMaxLength200 as $maxLengthKey => $maxLengthName) {
            $validator->allowEmpty($maxLengthKey)->add($maxLengthKey, [
                'maxLength' => [
                    'rule'    => ['maxLength', 200],
                    'message' => Utility::validMsg(Message::WITHIN, [$maxLengthName, '２００'])
                ]
            ]);
        }

        $aryMaxLength512 = [
            'memo' => 'メモ'
            ,'moushikomi_shasonota_renraku_jikou' => '申込者その他連絡事項'
            ,'chingarinin' => '賃借人'
            ,'bikou' => '備考'
        ];
        foreach ($aryMaxLength512 as $maxLengthKey => $maxLengthName) {
            $validator->allowEmpty($maxLengthKey)->add($maxLengthKey, [
                'maxLength' => [
                    'rule'    => ['maxLength', 512],
                    'message' => Utility::validMsg(Message::WITHIN, [$maxLengthName, '５１２'])
                ]
            ]);
        }

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
//        $rules->add($rules->existsIn(['m_system_kaiinshurui_id'], 'MSystemKaiinshuruis'));
//        $rules->add($rules->existsIn(['m_system_bukkenkubun_id'], 'MSystemBukkenkubuns'));
//        $rules->add($rules->existsIn(['m_system_kyojuueria_id'], 'MSystemKyojuuerias'));
//        $rules->add($rules->existsIn(['m_system_shonendo_nenkaihi_id'], 'MSystemShonendoNenkaihis'));
//        $rules->add($rules->existsIn(['m_system_kaihikubun_id'], 'MSystemKaihikubuns'));
//        $rules->add($rules->existsIn(['m_system_juotakumeika_id'], 'MSystemJuotakumeikas'));
//        $rules->add($rules->existsIn(['m_system_manshonmei_id'], 'MSystemManshonmeis'));
//        $rules->add($rules->existsIn(['m_system_shiten_id'], 'MSystemShitens'));
//        $rules->add($rules->existsIn(['m_system_kihonsyubetu_id'], 'MSystemKokyakuKihonsyubetus'));
//        $rules->add($rules->existsIn(['m_system_kaiinenji_id'], 'MSystemKokyakuKaiinenjis'));
//        $rules->add($rules->existsIn(['m_system_tantousha_id'], 'MSystemTantoushas'));
//        $rules->add($rules->existsIn(['m_system_sabisukubun_id'], 'MSystemSabisukubuns'));
//        $rules->add($rules->existsIn(['m_mediation_gensen_id'], 'MMediationGensens'));

        return $rules;
    }


    //ﾒｰﾙﾏｶﾞｼﾞﾝ配信
    const MEIRUMEGAJIN_HAISHIN = [
        1 => '希望',
        2 => '不要'
    ];

    //同居人と家族の有無
    const DOUKYO_HITOKAZAKU = [
        1 => '有り',
        2 => '無し'
    ];

    //承諾書受領状況
    const SHOUDAKUSHO_JURYOU_JOUKYOU = [
        1 => '未受領'
    ];

    //承諾書返信
    const SHOUDAKUSHO_HENSHIN = [
        1 => '未受領',
        2 => '返信'
    ];

    const SHUBETSU_SONOTA = 4;
    //種別
    const SHUBETSU = [
        1 => '駆け付け',
        2 => '専門相談',
        3 => '暮らしサービス',
        self::SHUBETSU_SONOTA => 'その他'
    ];

    //性別
    const SEIBETSU = [
        1 => '男',
        2 => '女',
        3 => '不明'
    ];

    const TAB_MEMO = 1;
    const TAB_NAKADEN_JOUHOU = 4;
    const TAB_RIREKI_KANRI = 7;
    //tab
    const TAB = [
        self::TAB_MEMO => 'メモ・連絡先',
        2 => '申込者情報',
        3 => '家族情報',
        self::TAB_NAKADEN_JOUHOU => '中電情報',
        5 => '賃貸解約情報',
        6 => 'SH・口座情報',
        self::TAB_RIREKI_KANRI => '履歴管理'
    ];

    const KENSAKU_TAISHOU_MOUSHIKOMI_SHA = 1;
    const KENSAKU_TAISHOU_SAABISU_KIBOU = 2;
    const KENSAKU_TAISHOU_JUYOUBASHO = 3;
    const KENSAKU_TAISHOU_KEIYAKU_SHA = 4;
    const KENSAKU_TAISHOU_KAZOKU = 5;

    const KENSAKU_TAISHOU = [
        self::KENSAKU_TAISHOU_MOUSHIKOMI_SHA => '申込者',
        self::KENSAKU_TAISHOU_SAABISU_KIBOU => 'サービス希望住所',
        self::KENSAKU_TAISHOU_JUYOUBASHO => '需要場所',
        self::KENSAKU_TAISHOU_KEIYAKU_SHA => '契約者',
        self::KENSAKU_TAISHOU_KAZOKU => '家族',
    ];

    const HIZUKEKOUMOUKU = [
        1 => 'お申し込み日', //moushibi
        2 => '解約受付日', //kaiyaku_uketsukebi
        3 => '解約書類送付日', //kaiyaku_shosoufubi
        4 => 'JBR解約通知', //jbr_kaiyaku_tsuchi
        5 => 'サービス開始日', //sabisu_kaishibi
        6 => '次回口座振替予定日', //jikaikouzafurikae_yoteibi
        7 => 'GMO更新予定日', //gmo_koushin_yoteibi
        8 => '更新確認フラグ', //koushin_kakunin_furagu
    ];

    const HIZUKEKOUMOUKU_FIELDS = [
        1 => 'moushibi',
        2 => 'kaiyaku_uketsukebi',
        3 => 'kaiyaku_shosoufubi',
        4 => 'jbr_kaiyaku_tsuchi',
        5 => 'sabisu_kaishibi',
        6 => 'jikaikouzafurikae_yoteibi',
        7 => 'gmo_koushin_yoteibi',
        8 => 'koushin_kakunin_furagu',
    ];
}
