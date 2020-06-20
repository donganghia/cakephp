<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrderAttachedFile Model
 *
 * @method \App\Model\Entity\OrderAttachedFile get($primaryKey, $options = [])
 * @method \App\Model\Entity\OrderAttachedFile newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\OrderAttachedFile[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrderAttachedFile|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderAttachedFile|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\OrderAttachedFile patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\OrderAttachedFile[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrderAttachedFile findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrderAttachedFileTable extends BaseTable
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

        $this->setTable('order_attached_file');
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
            ->scalar('view_name')
            ->maxLength('view_name', 200)
            ->allowEmpty('view_name');

        return $validator;
    }
}
