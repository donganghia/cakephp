<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * MSupplier Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $MSystemShiiresakiKategoris
 * @property |\Cake\ORM\Association\BelongsTo $MSystemTantoushas
 * @property |\Cake\ORM\Association\HasMany $MSupplierProduct
 * @property \App\Model\Table\MUserTable|\Cake\ORM\Association\HasMany $MUser
 *
 * @method \App\Model\Entity\MSupplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\MSupplier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MSupplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MSupplier|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSupplier|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSupplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MSupplier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MSupplier findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MSupplierTable extends BaseTable
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

        $this->setTable('m_supplier');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

//        $this->belongsTo('MSystemShiiresakiKategoris', [
//            'foreignKey' => 'm_system_shiiresaki_kategori_id'
//        ]);
//        $this->belongsTo('MSystemTantoushas', [
//            'foreignKey' => 'm_system_tantousha_id',
//            'joinType' => 'INNER'
//        ]);
        $this->hasMany('MSupplierProduct', [
            'foreignKey' => 'm_supplier_id'
        ]);
        $this->hasMany('MUser', [
            'foreignKey' => 'm_supplier_id'
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
            ->integer('area')
            ->allowEmpty('area', 'create');

        $validator
            ->scalar('koudo')
            ->maxLength('koudo', 20)
            ->requirePresence('koudo', 'create')
            ->notEmpty('koudo');

        $validator
            ->scalar('mei_1')
            ->maxLength('mei_1', 200)
            ->allowEmpty('mei_1');

        $validator
            ->scalar('mei_2')
            ->maxLength('mei_2', 200)
            ->allowEmpty('mei_2');

        $validator
            ->scalar('ryakushou')
            ->maxLength('ryakushou', 200)
            ->allowEmpty('ryakushou');

        $validator
            ->scalar('sakuin')
            ->maxLength('sakuin', 200)
            ->allowEmpty('sakuin');

        $validator
            ->scalar('yuubenbangou')
            ->maxLength('yuubenbangou', 200)
            ->allowEmpty('yuubenbangou');

        $validator
            ->scalar('juusho_1')
            ->maxLength('juusho_1', 512)
            ->allowEmpty('juusho_1');

        $validator
            ->scalar('juusho_2')
            ->maxLength('juusho_2', 512)
            ->allowEmpty('juusho_2');

        $validator
            ->scalar('juusho_3')
            ->maxLength('juusho_3', 512)
            ->allowEmpty('juusho_3');

        $validator
            ->scalar('kasutama_bakoudo')
            ->maxLength('kasutama_bakoudo', 200)
            ->allowEmpty('kasutama_bakoudo');

        $validator
            ->scalar('denwa')
            ->maxLength('denwa', 20)
            ->allowEmpty('denwa');

        $validator
            ->scalar('fax')
            ->maxLength('fax', 20)
            ->allowEmpty('fax');

        $validator
            ->allowEmpty('shiharai_saki_kubun');

        $validator
            ->scalar('aitesaki_tantousha_mei')
            ->maxLength('aitesaki_tantousha_mei', 200)
            ->allowEmpty('aitesaki_tantousha_mei');

        $validator
            ->scalar('bikou')
            ->maxLength('bikou', 512)
            ->allowEmpty('bikou');

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
        //$rules->add($rules->existsIn(['m_system_shiiresaki_kategori_id'], 'MSystemShiiresakiKategoris'));
        //$rules->add($rules->existsIn(['m_system_tantousha_id'], 'MSystemTantoushas'));

        return $rules;
    }

    const PREFECTURE_DATA = [
        self::IS_EMPTY => '-',
        '北海道' => '北海道',
        '青森県' => '青森県',
        '岩手県' => '岩手県',
        '宮城県' => '宮城県',
        '秋田県' => '秋田県',
        '山形県' => '山形県',
        '福島県' => '福島県',
        '茨城県' => '茨城県',
        '栃木県' => '栃木県',
        '群馬県' => '群馬県',
        '埼玉県' => '埼玉県',
        '千葉県' => '千葉県',
        '東京都' => '東京都',
        '神奈川県' => '神奈川県',
        '新潟県' => '新潟県',
        '富山県' => '富山県',
        '石川県' => '石川県',
        '福井県' => '福井県',
        '山梨県' => '山梨県',
        '長野県' => '長野県',
        '岐阜県' => '岐阜県',
        '静岡県' => '静岡県',
        '愛知県' => '愛知県',
        '三重県' => '三重県',
        '滋賀県' => '滋賀県',
        '京都府' => '京都府',
        '大阪府' => '大阪府',
        '兵庫県' => '兵庫県',
        '奈良県' => '奈良県',
        '和歌山県' => '和歌山県',
        '鳥取県' => '鳥取県',
        '島根県' => '島根県',
        '岡山県' => '岡山県',
        '広島県' => '広島県',
        '山口県' => '山口県',
        '徳島県' => '徳島県',
        '香川県' => '香川県',
        '愛媛県' => '愛媛県',
        '高知県' => '高知県',
        '福岡県' => '福岡県',
        '佐賀県' => '佐賀県',
        '長崎県' => '長崎県',
        '熊本県' => '熊本県',
        '大分県' => '大分県',
        '宮崎県' => '宮崎県',
        '鹿児島県' => '鹿児島県',
        '沖縄県' => '沖縄県',
    ];

    //担当者名
    const TANTOUSHA_MEI = [
        0 => '代表',
        1 => '中野',
        2 => '瀬戸',
        3 => '兼山'
    ];

    //単価設定区分
    const HIIRE_TANKA_SETTEI_KUBUN = [
        0 => '商品設定',
        1 => '税抜き',
        2 => '税込'
    ];

}
