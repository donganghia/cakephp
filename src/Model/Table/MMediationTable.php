<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

/**
 * MMediation Model
 *
 * @method \App\Model\Entity\MMediation get($primaryKey, $options = [])
 * @method \App\Model\Entity\MMediation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MMediation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MMediation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MMediation|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MMediation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MMediation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MMediation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MMediationTable extends BaseTable
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

        $this->setTable('m_mediation');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->allowEmpty('name');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }
}
