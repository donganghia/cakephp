<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Libs\Utility;
use App\Libs\Message;

/**
 * MCustomerHistory Model
 *
 * @property \App\Model\Table\MCustomersTable|\Cake\ORM\Association\BelongsTo $MCustomers
 * @property \App\Model\Table\HistoriesTable|\Cake\ORM\Association\BelongsTo $Histories
 * @property \App\Model\Table\SynergiesTable|\Cake\ORM\Association\BelongsTo $Synergies
 *
 * @method \App\Model\Entity\MCustomerHistory get($primaryKey, $options = [])
 * @method \App\Model\Entity\MCustomerHistory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MCustomerHistory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MCustomerHistory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MCustomerHistory|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MCustomerHistory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MCustomerHistory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MCustomerHistory findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MCustomerHistoryTable extends BaseTable
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

        $this->setTable('m_customer_history');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MCustomer', [
            'foreignKey' => 'm_customer_id',
            'joinType' => 'INNER'
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
            ->allowEmpty('shubetsu');

        $validator
            ->scalar('rireki_renban')
            ->maxLength('rireki_renban', 20)
            ->notEmpty('rireki_renban', Utility::validMsg(Message::REQUIRED, ['履歴連番']));

        $validator
            ->scalar('smile_no')
            ->maxLength('smile_no', 20)
            ->allowEmpty('smile_no');

        $validator
            ->date('hidzuke')
            ->allowEmpty('hidzuke');

        $validator
            ->scalar('kanri_bangou')
            ->maxLength('kanri_bangou', 20)
            ->allowEmpty('kanri_bangou');

        $validator
            ->scalar('shimei')
            ->maxLength('shimei', 200)
            ->allowEmpty('shimei');

        $validator
            ->allowEmpty('taitoru');

        $validator
            ->scalar('irai_naiyou')
            ->maxLength('irai_naiyou', 512)
            ->allowEmpty('irai_naiyou');

        $validator
            ->scalar('taiou_naiyou')
            ->maxLength('taiou_naiyou', 512)
            ->allowEmpty('taiou_naiyou');

        $validator
            ->scalar('kureemu')
            ->allowEmpty('kureemu');

        $validator
            ->allowEmpty('taiou_gyousha');

        $validator
            ->allowEmpty('tantoushamei');

        $validator
            ->scalar('bikou')
            ->maxLength('bikou', 512)
            ->allowEmpty('bikou');

        $validator
            ->scalar('hanbai_juchuu_bangou')
            ->maxLength('hanbai_juchuu_bangou', 20)
            ->allowEmpty('hanbai_juchuu_bangou');

        $validator
            ->date('sabisu_jisshibi')
            ->allowEmpty('sabisu_jisshibi');

        $validator
            ->scalar('kureemu_naiyou_taiou')
            ->maxLength('kureemu_naiyou_taiou', 512)
            ->allowEmpty('kureemu_naiyou_taiou');

        $validator
            ->allowEmpty('ankeeto_haifu');
        
        $validator
            ->scalar('ankeeto_kaitoo')
            ->maxLength('ankeeto_kaitoo', 512)
            ->allowEmpty('ankeeto_kaitoo');

        $validator
            ->allowEmpty('manzokudo');

         $validator
            ->scalar('manzokudo_riyuu')
            ->maxLength('manzokudo_riyuu', 512)
            ->allowEmpty('manzokudo_riyuu');

        $validator
            ->allowEmpty('kakaku_manzokudo');

        $validator
            ->scalar('kakaku_manzokudo_riyuu')
            ->maxLength('kakaku_manzokudo_riyuu', 512)
            ->allowEmpty('kakaku_manzokudo_riyuu');

        $validator
            ->scalar('sutaffu_nitsuite')
            ->maxLength('sutaffu_nitsuite', 512)
            ->allowEmpty('sutaffu_nitsuite');

        $validator
            ->scalar('sonota_iken')
            ->maxLength('sonota_iken', 512)
            ->allowEmpty('sonota_iken');

        $validator
            ->scalar('taiou_joukyou')
            ->maxLength('taiou_joukyou', 512)
            ->allowEmpty('taiou_joukyou');

        $validator
            ->scalar('yobi')
            ->maxLength('yobi', 512)
            ->allowEmpty('yobi');

        $validator
            ->date('uketsukebi')
            ->allowEmpty('uketsukebi');

        $validator
            ->scalar('uketsuke_bangou')
            ->maxLength('uketsuke_bangou', 20)
            ->allowEmpty('uketsuke_bangou');

        $validator
            ->integer('hanbai_kingaku')
            ->allowEmpty('hanbai_kingaku');

        $validator
            ->integer('hatchuu_kingaku')
            ->allowEmpty('hatchuu_kingaku');

        $validator
            ->integer('rireki_tesuuryou')
            ->allowEmpty('rireki_tesuuryou');

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
        // $rules->add($rules->existsIn(['m_customer_id'], 'MCustomer'));

        return $rules;
    }


    // ンケート配布
    const ANKEETO_HAIFU_VALUES = [
        1 => "有",
        2 => "無",
    ];

    // 満足度
    const MANZOKUDO_VALUES = [
        1 => "満足している",
        2 => "満足していない",
    ];

    // 価格満足度
    const KAKAKU_MANZOKUDO_VALUES = [
        1 => "満足している",
        2 => "満足していない",
    ];

    // タイトル When type = 1,2,4
    const TAITORU_1_VALUES = [
        1 => "カギ",
        2 => "水まわり",
        3 => "ガラス",
        4 => "在宅確認",
    ];

    // タイトル When type = 3
    const TAITORU_2_VALUES = [
        1 => "健康・医療",
        2 => "美容",
        3 => "介護",
        4 => "育児・子育て",
        5 => "家庭学習ｱﾄﾞﾊﾞｲｽ",
        6 => "冠婚葬祭",
        7 => "ペットアドバイス",
        8 => "資格アドバイス",
        9 => "年金・税金",
        10 => "パソコン",
        11 => "生活防犯",
        12 => "近隣施設",
    ];

    // 対応業者
    const TAIOU_GYOUSHA_VALUES = [
        1 => "ＪＢＲ",
    ];

    // 担当者名
    const TANTOUSHAMEI_VALUES = [
        1 => "ＪＢＲ",
    ];
}
