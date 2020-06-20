<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderComment Model
 *
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\ProjectTable|\Cake\ORM\Association\BelongsTo $Project
 * @property \App\Model\Table\MSupplierTable|\Cake\ORM\Association\BelongsTo $MSupplier
 * @property \App\Model\Table\MUserTable|\Cake\ORM\Association\BelongsTo $LastUser
 *
 * @method \App\Model\Entity\OrderComment get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderComment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderComment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderComment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderComment|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderComment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderComment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderComment findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderCommentTable extends BaseTable
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

        $this->setTable('order_comment');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Project', [
            'foreignKey' => 'project_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('MSupplier', [
            'foreignKey' => 'm_supplier_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('LastUser', [
            'className' => 'MUser',
            'foreignKey' => 'last_user_modified',
            'joinType' => 'LEFT'
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
            ->scalar('anken_koudo')
            ->maxLength('anken_koudo', 200)
            ->requirePresence('anken_koudo', 'create')
            ->notEmpty('anken_koudo');

        $validator
            ->scalar('juchuu_bangou')
            ->maxLength('juchuu_bangou', 200)
            ->requirePresence('juchuu_bangou', 'create')
            ->notEmpty('juchuu_bangou');

        $validator
            ->scalar('juchuu_bangou')
            ->maxLength('juchuu_bangou', 200)
            ->allowEmpty('juchuu_bangou');

        $validator
            ->dateTime('last_comment_date')
            ->requirePresence('last_comment_date', 'create')
            ->notEmpty('last_comment_date');

        $validator
            ->integer('last_user_modified')
            ->requirePresence('last_user_modified', 'create')
            ->notEmpty('last_user_modified');

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
        $rules->add($rules->existsIn(['project_id'], 'Project'));
        $rules->add($rules->existsIn(['order_id'], 'Orders'));
        $rules->add($rules->existsIn(['m_supplier_id'], 'MSupplier'));

        return $rules;
    }
}
