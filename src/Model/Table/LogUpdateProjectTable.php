<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LogUpdateProject Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 * @property \App\Model\Table\OrdersTable|\Cake\ORM\Association\BelongsTo $Orders
 *
 * @method \App\Model\Entity\LogUpdateProject get($primaryKey, $options = [])
 * @method \App\Model\Entity\LogUpdateProject newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LogUpdateProject[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LogUpdateProject|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogUpdateProject|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogUpdateProject patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LogUpdateProject[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LogUpdateProject findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogUpdateProjectTable extends Table
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

        $this->setTable('log_update_project');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MUser', [
            'foreignKey' => 'm_user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
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
            ->scalar('bangou')
            ->maxLength('bangou', 200)
            ->requirePresence('bangou', 'create')
            ->notEmpty('bangou');

        $validator
            ->scalar('status')
            ->maxLength('status', 200)
            ->allowEmpty('status');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'));

        return $rules;
    }
}
