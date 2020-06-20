<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderDetail Model
 *
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\MProductsTable|\Cake\ORM\Association\BelongsTo $MProducts
 * @property \App\Model\Table\MSuppliersTable|\Cake\ORM\Association\BelongsTo $MSuppliers
 *
 * @method \App\Model\Entity\OrderDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderDetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderDetailTable extends BaseTable
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

        $this->setTable('order_detail');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MProduct', [
            'foreignKey' => 'm_product_id'
        ]);

        $this->belongsTo('MSupplier', [
            'foreignKey' => 'm_supplier_id'
        ]);

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id'
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
            ->allowEmpty('tani');

        $validator
            ->integer('suuryou')
            ->allowEmpty('suuryou');

        $validator
            ->date('nouki_kaishibi')
            ->allowEmpty('nouki_kaishibi');

        $validator
            ->date('nouki_shuuryoubi')
            ->allowEmpty('nouki_shuuryoubi');

        $validator
            ->allowEmpty('houmon_jikan_shuuryou')
            ->maxLength('nouki_kaishibi', 10);

        $validator
            ->allowEmpty('kakunin_joutai');

        $validator
            ->integer('sagyou_kikan')
            ->allowEmpty('sagyou_kikan');

        $validator
            ->integer('hatchuu_tanka')
            ->allowEmpty('hatchuu_tanka');

        $validator
            ->integer('hatchuu_kingaku')
            ->allowEmpty('hatchuu_kingaku');

        $validator
            ->integer('juchuu_tanka')
            ->allowEmpty('juchuu_tanka');

        $validator
            ->integer('juchuu_kingaku')
            ->allowEmpty('juchuu_kingaku');

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
//        $rules->add($rules->existsIn(['project_id'], 'Projects'));
//        $rules->add($rules->existsIn(['order_id'], 'Orders'));
//        $rules->add($rules->existsIn(['m_product_id'], 'MProducts'));
//        $rules->add($rules->existsIn(['m_supplier_id'], 'MSuppliers'));

        return $rules;
    }

    //事由
    const SHORI_JIYUU = [
        '顧客都合' => '顧客都合',
        '商品・仕入先都合' => '商品・仕入先都合',
        '天候・日程都合' => '天候・日程都合',
        'その他・特殊都合' => 'その他・特殊都合',
    ];

    //確認種別
    const KAKUNIN_TOUROKU = 1;
    const MODOSHI_JOUKEN = 2;
    const KAKUNIN_SHUBETSU = [
        self::KAKUNIN_TOUROKU => "確認登録済",
        self::MODOSHI_JOUKEN => "戻し条件"
    ];
    //完了種別
    const SAGYOU_KANRYOU = 3;
    const NOUHIN_KANRYOU = 4;
    const KANRYOU_SHUBETSU = [
        self::SAGYOU_KANRYOU => "作業完了",
        self::NOUHIN_KANRYOU => "納品完了"
    ];


    //見積依頼中
    const JOUTAI_KUBUN_MITSUMORI_IRAI_CHUU = 1;
    //見積提出
    const JOUTAI_KUBUN_MITSUMORI_TEISHUTSU = 2;
    //受注済
    const JOUTAI_KUBUN_JUCHUU_SUMI = 3;
    //発注済
    const JOUTAI_KUBUN_HATCHUU_SUMI = 4;
    //確認済
    const JOUTAI_KUBUN_KAKUNINZU = 5;
    //作業完了
    const JOUTAI_KUBUN_SAGYOU_KANRYOU = 6;
    //納品完了
    const JOUTAI_KUBUN_NOUHIN_KANRYOU = 7;
    //一括計上
    const JOUTAI_KUBUN_IKKATSU_KEIJOU = 8;
    //分割計上
    const JOUTAI_KUBUN_BUNKATSU_KEIJOU = 9;
    const KEIJOU_IS_CHECKED = 1;
    //完了確認のみ
    const JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI = 10;
    //繰上計上
    const JOUTAI_KUBUN_KURIGAMI_KEIJOU= 11;
    //キャンセル
    const JOUTAI_KUBUN_KYANSERU = 12;
    //失注
    const JOUTAI_KUBUN_SHITSU_CHUU = 13;

    //sort joutai_kubun by ASC
    const JOUTAI_KUBUN_ASC = [
        self::JOUTAI_KUBUN_MITSUMORI_IRAI_CHUU,
        self::JOUTAI_KUBUN_MITSUMORI_TEISHUTSU,
        self::JOUTAI_KUBUN_JUCHUU_SUMI,
        self::JOUTAI_KUBUN_HATCHUU_SUMI,
        self::JOUTAI_KUBUN_KAKUNINZU,
        self::JOUTAI_KUBUN_SAGYOU_KANRYOU,
        self::JOUTAI_KUBUN_NOUHIN_KANRYOU,
        self::JOUTAI_KUBUN_IKKATSU_KEIJOU,
        self::JOUTAI_KUBUN_BUNKATSU_KEIJOU,
        self::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI,
        self::JOUTAI_KUBUN_KURIGAMI_KEIJOU,
        self::JOUTAI_KUBUN_KYANSERU,
        self::JOUTAI_KUBUN_SHITSU_CHUU
    ];

    //sub for status
    const SUB_HATCHU_SUMI_MODOSHI = '　ー　戻し';
    const SUB_KEIJOU_SUMI = '　ー　済';
    const SUB_MITSUMORI_TEISHUTSU_SEIKAN = '　ー　静観';

    //確認しています。
    const STATUS_WAIT_CONFIRM = 0;
    const STATUS_CONFIRM = 1;
    const STATUS_FINISH = 2;
    const STATUS_RETURN = 3;

    //m_product: supplier id is null
    const EKURASHI_KAISHA_ID = 0;
    const EKURASHI_KAISHA_MEI = 'E-KURASHI';

    const STATUS_VALUE = [
        self::STATUS_WAIT_CONFIRM => '確認待ち',
        self::STATUS_CONFIRM => '確認しました',
        self::STATUS_FINISH => '完了登録',
        self::STATUS_RETURN => '戻し条件',
    ];

    const OKYAKUSAMA_KAKUNIN_VALUE = [
        1 => '作業完了後、立ち会いを行いました',
        '依頼したサービスが完了又は商品を受領しました',
        '日付け・署名・押印受領'
    ];

    const HENKOU_NASHI = 1;
    const HENKOU_ARI = 2;
    const HENKOU_TAIOU_VALUE = [
        self::HENKOU_NASHI => '変更無し',
        self::HENKOU_ARI => '金額変更有り'
    ];
}
