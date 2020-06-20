<?php
namespace App\Model\Table;

use App\Libs\Constant;
use App\Libs\Message;
use App\Libs\Utility;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

/**
 * MUser Model
 *
 * @property \App\Model\Table\MRoleTable|\Cake\ORM\Association\BelongsTo $MRoles
 * @property \App\Model\Table\MSupplierTable|\Cake\ORM\Association\BelongsTo $MSuppliers
 *
 * @method \App\Model\Entity\MUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\MUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MUser|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MUserTable extends BaseTable
{

    const TYPE_E_KURASHI = 1;
    const TYPE_PARTNER = 2;
    const TYPE_END_USER = 3;

    const TYPE_VALUE = [
        self::TYPE_E_KURASHI => 'e-暮らし',
        self::TYPE_PARTNER => '委託先',
//        self::TYPE_END_USER => '会員'
    ];

    const IS_ACTIVE_VALUE = [
        0 => '無',
        1 => '有'
    ];

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('m_user');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MRole', [
            'foreignKey' => 'm_role_id'
        ]);
        $this->belongsTo('MSupplier', [
            'foreignKey' => 'm_supplier_id'
        ]);
    }

    /**
     * @param Validator $validator
     * @return Validator
     */
    private function newUser(Validator $validator) {
        $validator
            ->notEmpty('username', Utility::validMsg(Message::REQUIRED, ['利用者ＩＤ']))
            ->add('username', [
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
                    'message' => Utility::validMsg(Message::NOT_SPECIAL_CHARACTER, ['利用者ＩＤ'])
                ],
                'unique' => [
                    'rule' => function ($value, $context) {
                        $countUser = $this->find()->where(['username' => $value])->count();
                        return !$countUser;
                    },
                    'message' => __('利用者ＩＤが既に存在しています。')
                ],
                'minLength'  => [
                    'rule'    => ['minLength', 6],
                    'last'    => TRUE,
                    'message' => Utility::validMsg(Message::WITHIN_6_20, ['利用者'])
                ],
                'maxLength'  => [
                    'rule'    => ['maxLength', 20],
                    'message' => Utility::validMsg(Message::WITHIN_6_20, ['利用者'])
                ]
            ]);

        $validator
            ->notEmpty('password', Utility::validMsg(Message::REQUIRED, ['パスワード']))
            ->add('password', [
                'minLength'  => [
                    'rule'    => ['minLength', 6],
                    'last'    => TRUE,
                    'message' => Utility::validMsg(Message::WITHIN_6_20, ['パスワード'])
                ],
                'maxLength'  => [
                    'rule'    => ['maxLength', 20],
                    'message' => Utility::validMsg(Message::WITHIN_6_20, ['パスワード'])
                ],
                'compare' => [
                    'rule' => ['compareWith', 're_new_password'],
                    'message' => Utility::validMsg('%sが一致しません。', ['パスワード（確認）'])
                ]
            ]);

        $validator
            ->notEmpty('name', ['message' => Utility::validMsg(Message::REQUIRED, ['名前'])])
            ->add('name', [
                'maxLength' => [
                    'rule'    => ['maxLength', 200],
                    'message' => Utility::validMsg(Message::WITHIN, ['名前', '２００'])
                ]
            ]);

        $validator->allowEmpty('mail')
            ->add('mail', 'validFormat', [
                'rule' => 'email',
                'message' => Utility::validMsg(Message::INCORRECT, ['メールアドレス'])
            ]);

        $validator
            ->boolean('is_active')
            ->requirePresence('is_active', 'create')
            ->notEmpty('is_active');

        return $validator;
    }

    /**
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        return $this->newUser($validator);
    }

    /**
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationForPartner(Validator $validator)
    {
        $validator = $this->newUser($validator);

        $validator->notEmpty('m_supplier_id', ['message' => Utility::validMsg(Message::REQUIRED, ['仕入先'])]);

        return $validator;
    }

    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['username']));

        return $rules;
    }

    public function findAuth(Query $query, array $options) {
        return $query->andWhere(['MUser.deleted is' => null, 'MUser.is_active' => Constant::ON]);
    }

    public function beforeSave($event, $entity) {
        if($entity->id && (!isset($entity->re_new_password) || !$entity->re_new_password)) {

        } else {
            $objHasher = new DefaultPasswordHasher();
            $entity->password = $objHasher->hash($entity->password);
        }
    }
}
