<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderCommentDetail Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\OrderCommentsTable|\Cake\ORM\Association\BelongsTo $OrderComments
 *
 * @method \App\Model\Entity\OrderCommentDetail get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderCommentDetail newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderCommentDetail[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderCommentDetail|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderCommentDetail|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderCommentDetail patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderCommentDetail[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderCommentDetail findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderCommentDetailTable extends BaseTable
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

        $this->setTable('order_comment_detail');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUser', [
            'foreignKey' => 'm_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('OrderComment', [
            'foreignKey' => 'order_comment_id',
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
            ->scalar('content')
            ->maxLength('content', 200)
            ->requirePresence('content', 'create')
            ->notEmpty('content');

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
        $rules->add($rules->existsIn(['m_user_id'], 'MUser'));
        $rules->add($rules->existsIn(['order_comment_id'], 'OrderComment'));

        return $rules;
    }
}
