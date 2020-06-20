<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MSupplierProduct Model
 *
 * @property \App\Model\Table\MSuppliersTable|\Cake\ORM\Association\BelongsTo $MSuppliers
 * @property \App\Model\Table\MSystemShiiretankaTorihikisakisTable|\Cake\ORM\Association\BelongsTo $MSystemShiiretankaTorihikisakis
 *
 * @method \App\Model\Entity\MSupplierProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\MSupplierProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MSupplierProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MSupplierProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSupplierProduct|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSupplierProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MSupplierProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MSupplierProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MSupplierProductTable extends BaseTable
{

    const IS_EMPTY = null;
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('m_supplier_product');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MSupplier', [
            'foreignKey' => 'm_supplier_id',
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
            ->allowEmpty('tanka_masuta_kubun');

        $validator
            ->allowEmpty('tanka_shurui');

        $validator
            ->scalar('shouhin_mei')
            ->maxLength('shouhin_mei', 200)
            ->requirePresence('shouhin_mei', 'create')
            ->notEmpty('shouhin_mei');

        $validator
            ->allowEmpty('tanka_shubetsu');

        $validator
            ->integer('tanka')
            ->allowEmpty('tanka');

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
//        $rules->add($rules->existsIn(['m_supplier_id'], 'MSuppliers'));
//        $rules->add($rules->existsIn(['m_system_shiiretanka_torihikisaki_id'], 'MSystemShiiretankaTorihikisakis'));

        return $rules;
    }

    //単価ﾏｽﾀｰ区分
    const TANKA_MASUTA_KUBUN = [
        1 => '仕入単価'
    ];

    //単価種類
    const TANKA_SHURUI = [
        1 => '仕入先別商品'
    ];
    //単価種別
    const TANKA_SHUBETSU = [
        0 => '単価'
    ];
}
