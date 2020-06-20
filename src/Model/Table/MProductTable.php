<?php
namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use App\Libs\Message;
use App\Libs\Utility;
/**
 * MProduct Model
 *
 * @property \App\Model\Table\KategorisTable|\Cake\ORM\Association\BelongsTo $Kategoris
 *
 * @method \App\Model\Entity\MProduct get($primaryKey, $options = [])
 * @method \App\Model\Entity\MProduct newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MProduct[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MProduct|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MProduct|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MProduct patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MProduct[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MProduct findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MProductTable extends BaseTable
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

        $this->setTable('m_product');
        $this->setDisplayField('id');
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
            ->notEmpty('koudo', Utility::validMsg(Message::REQUIRED, ['商品コード']))
            ->add('koudo', [
                'validChars' => [
                    'rule' => function ($value, $context) {
                        if ((preg_match("#[0-9]#", $value)
                                || preg_match("#[A-Z]#", $value)
                                || preg_match("#[a-z]#", $value))
                            && !preg_match("#\W+#", $value)
                        ) {
                            return true;
                        } else return false;
                    },
                    'message' => Utility::validMsg(Message::NOT_SPECIAL_CHARACTER, ['商品コード'])
                ],
                'maxLength'  => [
                    'rule'    => ['maxLength', 20],
                    'message' => Utility::validMsg(Message::WITHIN_1_20, ['商品コード'])
                ]
            ]);

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
        //$rules->add($rules->existsIn(['kategori_id'], 'Kategoris'));

        return $rules;
    }

    //単位
    const TANI_FORMULA = 1;
    const TANI_SHEETS = 2;
    const TANI_PLATFORM = 3;
    const TANI_M2 = 4;
    const TANI_TATAMI = 5;
    const TANI_PIECE = 6;
    const TANI_BOOK = 7;
    const TANI_BOX = 8;

    const TANI_VALUE = [
        self::TANI_FORMULA => '式',
        self::TANI_SHEETS => '枚',
        self::TANI_PLATFORM => '台',
        self::TANI_M2 => '㎡',
        self::TANI_TATAMI => '畳',
        self::TANI_PIECE => '個',
        self::TANI_BOOK => '本',
        self::TANI_BOX => '箱'
    ];

    //非課税区分
    const HIKAZEI_KUBUN_TAX = 1;
    const HIKAZEI_KUBUN_TAX_FREE = 2;

    const HIKAZEI_KUBUN_VALUE = [
        self::TANI_FORMULA => '課税',
        self::TANI_SHEETS => '非課税',
    ];

    //セット区分
    const SETTO_KUBUN_NORMAL = 0;
    const SETTO_KUBUN_SET_A = 1;
    const SETTO_KUBUN_SET_B = 2;

    const SETTO_KUBUN_VALUE = [
        self::SETTO_KUBUN_NORMAL => '通常',
        self::SETTO_KUBUN_SET_A => 'Aセット',
        self::SETTO_KUBUN_SET_B => 'Bセット',
    ];

    //分類名
    const BUNRUI_KOUDO_SERVICE = 1;
    const BUNRUI_KOUDO_SALES = 2;

    const BUNRUI_KOUDO_VALUE = [
        self::BUNRUI_KOUDO_SERVICE => 'サービス',
        self::BUNRUI_KOUDO_SALES => '物販',
    ];

    //売上単価設定
    const URIAGE_TANKA_SETTEI_KUBUN_TAX_EXCLUSION = 0;
    const URIAGE_TANKA_SETTEI_KUBUN_TAX = 1;

    const URIAGE_TANKA_SETTEI_KUBUN_VALUE = [
        self::URIAGE_TANKA_SETTEI_KUBUN_TAX_EXCLUSION => '税抜き',
        self::URIAGE_TANKA_SETTEI_KUBUN_TAX => '税有り',
    ];

    //カテゴリー
    const SHOUHIN_KATEGORI_HOUSE_CLEANING = '001';
    const SHOUHIN_KATEGORI_HOUSEWORK = '002';
    const SHOUHIN_KATEGORI_PC_SUPPORT = '003';
    const SHOUHIN_KATEGORI_GARDEN_TREE_CARE_SUPPORT = '004';
    const SHOUHIN_KATEGORI_CONSTRUCTION = '005';
    const SHOUHIN_KATEGORI_GOODS_SALE = '006';
    const SHOUHIN_KATEGORI_CLEANING_BUSINESS = '007';
    const SHOUHIN_KATEGORI_HOME_ELECTRONICS_REPAIR = '008';
    const SHOUHIN_KATEGORI_ELECTRIC_RUSHING = '009';

    //在庫管理区分
    const ZAIKO_KANRI_KUBUN_TO_DO = 0;
    const ZAIKO_KANRI_KUBUN_DO_NOT = 1;

    const ZAIKO_KANRI_KUBUN_VALUE = [
        self::ZAIKO_KANRI_KUBUN_TO_DO => '行う',
        self::ZAIKO_KANRI_KUBUN_DO_NOT => '行わない',
    ];

    //販売区分
    const HANBAI_KUBUN_GENERAL = 0;
    const HANBAI_KUBUN_B2B2BC = 1;
    const HANBAI_KUBUN_PROMOTION = 2;
    const HANBAI_KUBUN_OTHER = 3;

    const HANBAI_KUBUN_VALUE = [
        self::HANBAI_KUBUN_GENERAL => '一般販売',
        self::HANBAI_KUBUN_B2B2BC => 'B2B2bC販売',
        self::HANBAI_KUBUN_PROMOTION => 'ｷｬﾝﾍﾟｰﾝ販売',
        self::HANBAI_KUBUN_OTHER => 'その他販売',
    ];

    //仕入先数
    const SHU_SHIIRESAKI_KOUDO_SINGLE = 0;
    const SHU_SHIIRESAKI_KOUDO_MULTI = 1;

    const SHU_SHIIRESAKI_KOUDO_VALUE = [
        self::SHU_SHIIRESAKI_KOUDO_SINGLE => '単一',
        self::SHU_SHIIRESAKI_KOUDO_MULTI => '複数',
    ];

    //仕入先設定
    const VENDOR_SETTING_ANY = 0;
    const VENDOR_SETTING_AONE = 1;
    const VENDOR_SETTING_NAK = 2;
    const VENDOR_SETTING_AT = 3;

    const VENDOR_SETTING_VALUE = [
        self::VENDOR_SETTING_ANY => 'A000001 ANY',
        self::VENDOR_SETTING_AONE => 'A000002 A-one',
        self::VENDOR_SETTING_NAK => 'A000003 ﾅｯｸ',
        self::VENDOR_SETTING_AT => 'A000004 アート'
    ];
}
