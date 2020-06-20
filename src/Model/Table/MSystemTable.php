<?php
namespace App\Model\Table;

use Cake\Validation\Validator;

/**
 * MSystem Model
 *
 * @method \App\Model\Entity\MSystem get($primaryKey, $options = [])
 * @method \App\Model\Entity\MSystem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MSystem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MSystem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSystem|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MSystem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MSystem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MSystem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MSystemTable extends BaseTable
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

        $this->setTable('m_system');
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
            ->scalar('type_name')
            ->maxLength('type_name', 200)
            ->allowEmpty('type_name');

        $validator
            ->scalar('name')
            ->maxLength('name', 200)
            ->allowEmpty('name');

        $validator
            ->scalar('description')
            ->maxLength('description', 512)
            ->allowEmpty('description');

        $validator
            ->dateTime('deleted')
            ->allowEmpty('deleted');

        return $validator;
    }

    const SYSTEM_KATEGORI_ID = 'KATEGORI_ID';
    const SYSTEM_SHIHARAI_SAKI_KUBUN = 'SHIHARAI_SAKI_KUBUN';
    const SYSTEM_TANTOUSHA = 'TANTOUSHA';
    const SYSTEM_KAIIN_SHURUI = 'KAIIN_SHURUI';
    const SYSTEM_BUKKEN_KUBUN = 'BUKKEN_KUBUN';
    const SYSTEM_KYOJUU_ARIA = 'KYOJUU_ARIA';
    const SYSTEM_SHIHARAI_HOUHOU = 'SHIHARAI_HOUHOU';
    const SYSTEM_SAABUSU_KUBUN = 'SAABUSU_KUBUN';
    const SYSTEM_SHONENDO_NENKAIHI = 'SHONENDO_NENKAIHI';
    const SYSTEM_KAIHI_KUBUN = 'KAIHI_KUBUN';
    const SYSTEM_JUUTAKU_MEEKAA = 'JUUTAKU_MEEKAA';
    const SYSTEM_MANSHON_MEI = 'MANSHON_MEI';
    const SYSTEM_SHITEN = 'SHITEN';
    const SYSTEM_KANJOU_KAMOKU = 'KANJOU_KAMOKU';
    const SYSTEM_KIHON_SHUBETSU = 'KIHON_SHUBETSU';
    const SYSTEM_KAIIN_NENJI = 'KAIIN_NENJI';
    const SYSTEM_KAMOKU_ID = 'KAMOKU_ID';
    const SYSTEM_BUMON_ID = 'BUMON_ID';
    const SYSTEM_ANKEN_CD = 'ANKEN_CD';
    const SYSTEM_HOUMON_JIKAN = 'HOUMON_JIKAN';
    const SYSTEM_JOUTAI_KUBUN = 'JOUTAI_KUBUN';
    const SYSTEM_KEIYAKU_MIKOMO_JIKI = 'KEIYAKU_MIKOMO_JIKI';

    const SYSTEM_CATEGORY = [
        self::SYSTEM_JOUTAI_KUBUN => '状態区分',
        self::SYSTEM_KEIYAKU_MIKOMO_JIKI => '契約見込み時期',
        self::SYSTEM_BUMON_ID => '部門',
        self::SYSTEM_KANJOU_KAMOKU => '勘定科目',
        self::SYSTEM_KAMOKU_ID => '補助科目',
        self::SYSTEM_HOUMON_JIKAN => '訪問時間',
        self::SYSTEM_SHIHARAI_HOUHOU => '支払方法',
        self::SYSTEM_TANTOUSHA => '担当者',
        self::SYSTEM_KATEGORI_ID => 'カテゴリー',
        self::SYSTEM_KAIIN_SHURUI => '会員種類',
        self::SYSTEM_BUKKEN_KUBUN => '物件区分',
        self::SYSTEM_KYOJUU_ARIA => '居住エリア',
        self::SYSTEM_SAABUSU_KUBUN => 'サービス区分',
        self::SYSTEM_SHONENDO_NENKAIHI => '初年度年会費',
        self::SYSTEM_KAIHI_KUBUN => '会費区分',
        self::SYSTEM_JUUTAKU_MEEKAA => '住宅メーカー',
        self::SYSTEM_MANSHON_MEI => 'マンション名',
        self::SYSTEM_SHITEN => '支店',
        self::SYSTEM_KIHON_SHUBETSU => '基本種別',
        self::SYSTEM_KAIIN_NENJI => '会員年次',
        self::SYSTEM_ANKEN_CD => '案件CD'
    ];

    const HIDDEN_SYSTEM_CATEGORY = [
        self::SYSTEM_KATEGORI_ID  => 'カテゴリー',
        self::SYSTEM_KAIIN_SHURUI => '会員種類',
        self::SYSTEM_BUKKEN_KUBUN => '物件区分',
        self::SYSTEM_KYOJUU_ARIA => '居住エリア',
        self::SYSTEM_SHIHARAI_SAKI_KUBUN => '支払先区分 ',
        self::SYSTEM_SAABUSU_KUBUN => 'サービス区分',
        self::SYSTEM_SHONENDO_NENKAIHI => '初年度年会費',
        self::SYSTEM_KAIHI_KUBUN => '会費区分',
        self::SYSTEM_JUUTAKU_MEEKAA => '住宅メーカー',
        self::SYSTEM_MANSHON_MEI => 'マンション名',
        self::SYSTEM_SHITEN => '支店',
        self::SYSTEM_KIHON_SHUBETSU => '基本種別',
        self::SYSTEM_KAIIN_NENJI => '会員年次',
        self::SYSTEM_HOUMON_JIKAN => '訪問時間',
        self::SYSTEM_TANTOUSHA => '担当者',
    ];
}
