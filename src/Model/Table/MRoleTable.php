<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

/**
 * MRole Model
 *
 * @method \App\Model\Entity\MRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\MRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MRole|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MRole findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MRoleTable extends BaseTable
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

        $this->setTable('m_role');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('MUser', [
            'foreignKey' => 'm_role_id'
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
            ->scalar('name')
            ->maxLength('name', 200)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
}
