<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * LogLogin Model
 *
 * @property \App\Model\Table\MUsersTable|\Cake\ORM\Association\BelongsTo $MUsers
 *
 * @method \App\Model\Entity\LogLogin get($primaryKey, $options = [])
 * @method \App\Model\Entity\LogLogin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\LogLogin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\LogLogin|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogLogin|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\LogLogin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\LogLogin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\LogLogin findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LogLoginTable extends BaseTable
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

        $this->setTable('log_login');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsTo('MUsers', [
//            'foreignKey' => 'm_user_id'
//        ]);
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
            ->scalar('m_supplier_name')
            ->maxLength('m_supplier_name', 200)
            ->allowEmpty('m_supplier_name');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 200)
            ->allowEmpty('ip_address');

        $validator
            ->scalar('user_agent')
            ->maxLength('user_agent', 512)
            ->allowEmpty('user_agent');

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
       // $rules->add($rules->existsIn(['m_user_id'], 'MUsers'));

        return $rules;
    }
}
