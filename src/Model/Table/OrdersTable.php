<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Libs\Message;
use App\Libs\Utility;

/**
 * Orders Model
 *
 * @property \App\Model\Table\ProjectsTable|\Cake\ORM\Association\BelongsTo $Projects
 * @property \App\Model\Table\MSystemTantousTable|\Cake\ORM\Association\BelongsTo $MSystemTantous
 * @property \App\Model\Table\OrderAttachedFileTable|\Cake\ORM\Association\HasMany $OrderAttachedFile
 * @property \App\Model\Table\OrderDetailTable|\Cake\ORM\Association\HasMany $OrderDetail
 *
 * @method \App\Model\Entity\Order get($primaryKey, $options = [])
 * @method \App\Model\Entity\Order newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Order[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Order|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Order patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Order[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Order findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersTable extends BaseTable
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

        $this->setTable('orders');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Project', [
            'foreignKey' => 'project_id',
            'joinType'   => 'LEFT'
        ]);

        $this->hasMany('OrderDetail', [
            'foreignKey' => 'order_id'
        ]);

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator, $params = [])
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('bangou')
            ->maxLength('bangou', 200)
            ->allowEmpty('bangou');

        $validator
            ->allowEmpty('torihiki');

        $validator
            ->date('kibou_nouki_kaishi')
            ->allowEmpty('kibou_nouki_kaishi');

        $validator
            ->date('kibou_nouki_shuuryou')
            ->allowEmpty('kibou_nouki_shuuryou');

        $validator
            ->allowEmpty('juchuu_bangou');

        /*$validator
            ->notEmpty('juchuu_bangou', Utility::validMsg(Message::REQUIRED, ['見積No.']))
            ->add('juchuu_bangou', [
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
                    'message' => Utility::validMsg(Message::NOT_SPECIAL_CHARACTER, ['見積No.'])
                ],
                'maxLength'  => [
                    'rule'    => ['maxLength', 200],
                    'message' => Utility::validMsg(Message::WITHIN_1_20, ['見積No.'])
                ]
            ]);*/

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
//        $rules->add($rules->existsIn(['m_system_tantou_id'], 'MSystemTantous'));

        return $rules;
    }

    const TORIHIKI_URIKAKE = 1;

    const TORIHIKI_VALUE = [
        self::TORIHIKI_URIKAKE => '売掛',
        2 => '現金'
    ];

    //成約確度
    const SEIYAKU_KAKUDO_VALUE = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E'
    ];
    //予定注文: 処理状況
    const SHORI_JOUKYOU_MITSUMORI_CHUU = 1;
    const SHORI_MISTUMORI = 2;
    const SHORI_KYANSERY = 3;
    const SHORI_CHUU_SHITSU = 4;
    const SHORI_JOUKYOU = [
        self::SHORI_JOUKYOU_MITSUMORI_CHUU => "見積依頼中",
        self::SHORI_MISTUMORI => "見積提出済",
        self::SHORI_KYANSERY => "キャンセル",
        self::SHORI_CHUU_SHITSU => "失注"
    ];

    //確定注文: 登録種別
    const ZEN_KAKUTEI_SEI = 5;
    const YOTEIBI_KAKUNIN = 6;
    const SONOHOKA_KAKUNIN = 7;
    //戻し条件
    const MODOSHI_JOUKEN = 8;
    const KAKUTE_TYPE = [
        self::ZEN_KAKUTEI_SEI => "全確定済分",
        self::YOTEIBI_KAKUNIN => "予定日確認要",
        self::SONOHOKA_KAKUNIN => "予定日確認不要",
        self::MODOSHI_JOUKEN => "戻し条件"
    ];

    const STATUS_TEMP = 1;
    const STATUS_REGISTER = 2;

    const STATUS_NASHI = 1;
    const STATUS_ARI = 2;
    const STATUS_SYOKAI_VALUE = [
        self::STATUS_NASHI => '無し',
        self::STATUS_ARI => '有り'
    ];

}
