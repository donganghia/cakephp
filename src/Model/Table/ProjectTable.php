<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Libs\Message;
use App\Libs\Utility;

/**
 * Project Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKaiinshuruis
 * @property |\Cake\ORM\Association\BelongsTo $MSystemTantoushas
 * @property |\Cake\ORM\Association\BelongsTo $MSystemShiharaihouhous
 * @property |\Cake\ORM\Association\BelongsTo $MSystemBumons
 * @property |\Cake\ORM\Association\BelongsTo $MSystemKamokus
 * @property |\Cake\ORM\Association\BelongsTo $MMediationGensens
 * @property |\Cake\ORM\Association\BelongsTo $MCustomers
 * @property |\Cake\ORM\Association\BelongsTo $Shoukaishas
 *
 * @method \App\Model\Entity\Project get($primaryKey, $options = [])
 * @method \App\Model\Entity\Project newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Project[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Project|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Project patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Project[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Project findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ProjectTable extends BaseTable
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

        $this->setTable('project');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Orders', [
            'foreignKey' => 'project_id'
        ]);

        $this->belongsTo('MCustomer', [
            'foreignKey' => 'm_customer_id',
            'joinType'   => 'LEFT'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->allowEmpty('bangou');

        /*$validator
            ->notEmpty('bangou', Utility::validMsg(Message::REQUIRED, ['案件No.']))
            ->add('bangou', [
                'validChars' => [
                    'rule' => function ($value, $context) {
                        if ((preg_match("#[0-9]#", $value)
                                || preg_match("#[A-Z]#", $value)
                                || preg_match("#[a-z]#", $value))
                            && !preg_match("#\W+#", $value)
                        ) {
                            return true;
                        } else return false;
                    },
                    'message' => Utility::validMsg(Message::NOT_SPECIAL_CHARACTER, ['案件No.'])
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 200],
                    'message' => Utility::validMsg(Message::WITHIN_1_20, ['案件No.'])
                ]
            ]);*/

        $validator
            ->date('uriagebi')
            ->allowEmpty('uriagebi');

        $validator
            ->scalar('tokuisaki_koudo')
            ->maxLength('tokuisaki_koudo', 200)
            ->allowEmpty('tokuisaki_koudo');

        $validator
            ->date('kaiin_kaiyakubi')
            ->allowEmpty('kaiin_kaiyakubi');

        $validator
            ->scalar('sagyouchi')
            ->maxLength('sagyouchi', 512)
            ->allowEmpty('sagyouchi');

        $validator
            ->scalar('teimei')
            ->maxLength('teimei', 512)
            ->allowEmpty('teimei');

        $validator
            ->integer('gyou_bangou')
            ->allowEmpty('gyou_bangou');

        $validator
            ->nonNegativeInteger('hatchuu_tanka_goukei')
            ->allowEmpty('hatchuu_tanka_goukei');

        $validator
            ->nonNegativeInteger('hatchuu_kingaku_goukei')
            ->allowEmpty('hatchuu_kingaku_goukei');

        $validator
            ->nonNegativeInteger('shouhizei')
            ->allowEmpty('shouhizei');

        $validator
            ->nonNegativeInteger('ararigaku_goukei')
            ->allowEmpty('ararigaku_goukei');

        $validator
            ->nonNegativeInteger('uriage_yotei_goukei')
            ->allowEmpty('uriage_yotei_goukei');

        $validator
            ->nonNegativeInteger('uriage_zumi_goukei')
            ->allowEmpty('uriage_zumi_goukei');

        $validator
            ->scalar('shoukaisha_sonota_jouhou')
            ->maxLength('shoukaisha_sonota_jouhou', 200)
            ->allowEmpty('shoukaisha_sonota_jouhou');

        $validator
            ->allowEmpty('shoukai_tesuuryou_umu');

        $validator
            ->scalar('shoukai_tesuuryou_bikou')
            ->maxLength('shoukai_tesuuryou_bikou', 512)
            ->allowEmpty('shoukai_tesuuryou_bikou');

        $validator
            ->allowEmpty('sekisui_chuumonsho_umu');

        $validator
            ->date('sekisui_choumonsho_hidzuke')
            ->allowEmpty('sekisui_choumonsho_hidzuke');


        $validator
            ->allowEmpty('sekisui_shiharaitsuuchisho_umu');

        $validator
            ->date('sekisui_shiharaitsuuchisho_nyuukinbi')
            ->allowEmpty('sekisui_shiharaitsuuchisho_nyuukinbi');

        $validator
            ->scalar('sekisui_shiharaitsuuchisho_bikou')
            ->maxLength('sekisui_shiharaitsuuchisho_bikou', 512)
            ->allowEmpty('sekisui_shiharaitsuuchisho_bikou');

        $validator
            ->scalar('e_moushisha_yuubenbangou')
            ->maxLength('e_moushisha_yuubenbangou', 200)
            ->allowEmpty('e_moushisha_yuubenbangou');

        $validator
            ->scalar('e_moushisha_juushotodoufuken')
            ->maxLength('e_moushisha_juushotodoufuken', 200)
            ->allowEmpty('e_moushisha_juushotodoufuken');

        $validator
            ->scalar('e_moushisha_juushoshichou')
            ->maxLength('e_moushisha_juushoshichou', 512)
            ->allowEmpty('e_moushisha_juushoshichou');

        $validator
            ->scalar('e_sabisukibou_yuubenbangou')
            ->maxLength('e_sabisukibou_yuubenbangou', 200)
            ->allowEmpty('e_sabisukibou_yuubenbangou');

        $validator
            ->scalar('e_sabisukibou_juushotodoufuken')
            ->maxLength('e_sabisukibou_juushotodoufuken', 200)
            ->allowEmpty('e_sabisukibou_juushotodoufuken');

        $validator
            ->scalar('e_sabisukibou_juushoshichou')
            ->maxLength('e_sabisukibou_juushoshichou', 512)
            ->allowEmpty('e_sabisukibou_juushoshichou');

        $validator
            ->scalar('e_sabisukibou_juushomanshonmei')
            ->maxLength('e_sabisukibou_juushomanshonmei', 512)
            ->allowEmpty('e_sabisukibou_juushomanshonmei');

        $validator
            ->boolean('moushikomisha_douitsu')
            ->requirePresence('moushikomisha_douitsu', 'create')
            ->notEmpty('moushikomisha_douitsu');

        $validator
            ->allowEmpty('type');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

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
//        $rules->add($rules->existsIn(['m_system_tantousha_id'], 'MSystemTantoushas'));
//        $rules->add($rules->existsIn(['m_system_shiharaihouhou_id'], 'MSystemShiharaihouhous'));
//        $rules->add($rules->existsIn(['m_system_bumon_id'], 'MSystemBumons'));
//        $rules->add($rules->existsIn(['m_system_kamoku_id'], 'MSystemKamokus'));
//        $rules->add($rules->existsIn(['m_mediation_gensen_id'], 'MMediationGensens'));
//        $rules->add($rules->existsIn(['m_customer_id'], 'MCustomers'));
//        $rules->add($rules->existsIn(['shoukaisha_id'], 'Shoukaishas'));

        return $rules;
    }

    const YOTEI_TYPE = 1;
    const KAKUTEI_TYPE = 2;

    //確認種別
    const KAKUNIN_TOROUKU_NOMI = 1;
    const KAKUNIN_SHUBETSU = [
        self::KAKUNIN_TOROUKU_NOMI => "確認登録のみ",
        2 => "作業予定日返信要",
        3 => "その他条件確認要",
        4 => "確認TEL連絡要",
        5 => "戻し条件"
    ];


    const NITTEI_CHOUSEI_CHUU = 2;
    //確認状態
    const KAKUNIN_JOUTAI = [
        1 => '確認済み',
        self::NITTEI_CHOUSEI_CHUU => '日程調整中',
        3 => '打合せ完了'
    ];

    const JOUTSI_OPUSHON_VALUE = [
        '予定案件',
        '見積中',
        '予定日未確定',
        '予定日確定済',
        '作業未完了',
        '完了報告済み',
    ];

    //partnerの画面に状態オプション
    const PARTNER_JOUTAI_OPUSHON_VALUE = [
        '案件未確認',
        '予定日未確定',
        '作業未完了',
        //'完了未報告',
        //'完了報告済み'
    ];


}
