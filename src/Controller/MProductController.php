<?php

namespace App\Controller;

use App\Libs\Crypt;
use App\Libs\Message;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;
use App\Model\Table\OrderDetailTable;

/**
 * MProduct Controller
 *
 * @property \App\Model\Table\MProductTable $MProduct
 * @property \App\Model\Table\MSupplierProductTable $MSupplierProduct
 *
 * @method \App\Model\Entity\MProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MProductController extends AppController
{

    const SHOW_POPUP_PRODUCTS = 1;
    const SEARCH_POPUP_PRODUCTS = 2;

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mstSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KATEGORI_ID]);
        $mstSupplierProduct = $this->getMstSupplierProduct();
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder();//order
            $query = $this->searchDataByCondition();
            $mProducts = $this->paginate($query);

            $result = [];
            foreach ($mProducts as $key => $mProduct) {
                $result[$key][] = $this->tableActionField($mProduct->id, ['controller' => 'MProduct', 'action' => 'edit']);
                $result[$key][] = $mProduct->koudo;
                $result[$key][] = $mProduct->mei;
                $result[$key][] = $mProduct->mei_sakuin;
                $result[$key][] = isset(MProductTable::TANI_VALUE[$mProduct->tani])
                    ? MProductTable::TANI_VALUE[$mProduct->tani] : null;
                $result[$key][] = MProductTable::SETTO_KUBUN_VALUE[$mProduct->setto_hinkubun];
                $result[$key][] = $mProduct->hyoujun_uriage_tanka;
                $result[$key][] = isset(MProductTable::BUNRUI_KOUDO_VALUE[$mProduct->bunrui_koudo])
                    ? MProductTable::BUNRUI_KOUDO_VALUE[$mProduct->bunrui_koudo] : null;
                $result[$key][] = isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$mProduct->m_system_shouhin_kategori_id])
                    ? $mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$mProduct->m_system_shouhin_kategori_id] : null;
                $result[$key][] = isset(MProductTable::HIKAZEI_KUBUN_VALUE[$mProduct->hikazei_kubun])
                    ? MProductTable::HIKAZEI_KUBUN_VALUE[$mProduct->hikazei_kubun] : null;
                $result[$key][] = $mProduct->modified;
            }
            $this->datatableResponse($query, $result);
        }

        $this->set(compact('mstSystem', 'mstSupplierProduct'));
    }


    /**
     * Search Condition method
     *
     * @return object
     */
    public function searchDataByCondition()
    {
        //get all param search
        $pArySearch = $this->getQuerySearch();

        if ($pArySearch) {

            //like search condition
            foreach (["koudo", "mei", "mei_sakuin", "setto_hinkubun_mei", "edaban",
                         "jidou_furikae_shori_taishou_kubun_mei", "zaiko_kanri_kubun_mei",
                         "shu_shiiresaki_koudo", "shu_shiiresaki_mei"] as $field) {
                if ($strField = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']['MProduct.' . $field . ' LIKE'] = "%$strField%";
                }
            }

            //= search condition
            foreach (["tani", "bunrui_koudo", "m_system_shouhin_kategori_id", "shiiresaki_kazu", "m_supplier_product_id",
                         "hikazei_kubun", "setto_hinkubun", "uriage_tanka_settei_kubun", "shiiretanka_settei_kubun",
                         "zaiko_kanri_kubun"] as $field) {
                if ($value = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']['MProduct.' . $field] = $value;
                }
            }
        }

        return $this->MProduct->find()->where(['MProduct.deleted is' => null]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mstSupplierProduct = $this->getMstSupplierProduct();
        $mProduct = $this->MProduct->newEntity();
        if ($this->request->is('post')) {
            $mProduct = $this->MProduct->patchEntity($mProduct, $this->request->getData());
            $this->buildDataParams($mProduct);

            if ($this->MProduct->save($mProduct)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }

            if ($mProduct->getErrors()) {
                $this->errorFlash($mProduct->getErrors());
            }

        }
        $mstSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KATEGORI_ID]);
        $this->set(compact('mProduct', 'mstSystem', 'mstSupplierProduct'));
    }

    public function getSupplierId($id)
    {
        $mSupplierProduct = $this->MSupplierProduct->findById($id)->first();
        return $mSupplierProduct ? $mSupplierProduct->m_supplier_id : null;
    }

    public function getTanka($arySupplierProductId)
    {
        $result = $this->MSupplierProduct->find('all',
            [
                'fields' => ['total_tanka' => 'sum(tanka)'],
                'conditions' => [
                    'MSupplierProduct.id IN' => $arySupplierProductId,
                    'MSupplierProduct.deleted is' => null
                ]
            ]
        )->first();

        return $result ? $result->total_tanka : 0;
    }

    public function buildDataParams(&$mProduct)
    {
        $arr = $this->request->getData('m_supplier_product_id');

        if (!empty($arr)) {
            $mProduct->m_supplier_product_id = implode(",", $arr);
            $mProduct->m_supplier_id = $this->getSupplierId($arr[0]);
            $mProduct->tanka = $this->getTanka($arr);
        }

    }

    /**
     * Edit method
     *
     * @param string|null $id M Product id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = Crypt::decryptAES($id);
        $mProduct = $this->MProduct->find()->where(['id' => $id, 'deleted is' => null])->first();

        if(!$mProduct) {
            $this->errorFlash('商品が見つかりません。');
            return $this->redirect(['action' => 'index']);
        }

        $mstSupplierProduct = $this->getMstSupplierProduct();
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mProduct = $this->MProduct->patchEntity($mProduct, $this->request->getData());
            $this->buildDataParams($mProduct);
            if ($this->MProduct->save($mProduct)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }

            if($mProduct->getErrors()) {
                $this->errorFlash($mProduct->getErrors());
            }
        }

        $mstSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KATEGORI_ID]);
        $this->set(compact('mProduct', 'mstSystem', 'mstSupplierProduct'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mProduct = $this->MProduct->get($id);
        if ($this->MProduct->delete($mProduct)) {
            $this->Flash->success(__('The m product has been deleted.'));
        } else {
            $this->Flash->error(__('The m product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function simple()
    {
    }

    /**
     * get 単価
     *
     * @return \Cake\Http\Response|void
     */
    public function getListSupplierProduct()
    {
        if($this->request->is('ajax')) {
            $aryCondition = null;
            if($bunruiKoudo = $this->request->getData('bunrui_koudo')) {
                $aryCondition['MSupplierProduct.bunrui_koudo'] = $bunruiKoudo;
            }

            if($categoryid = $this->request->getData('m_system_shouhin_kategori_id')) {
                $aryCondition['MSupplier.m_system_shiiresaki_kategori_id'] = $categoryid;
            }

            $mstSupplierProduct = $this->getMstSupplierProduct($aryCondition);
            $this->jsonResponse(['data' => $mstSupplierProduct]);
        }
    }

    /**
     * CSV Export method
     *
     * @return json
     */
    public function csvExport()
    {
        if ($this->request->is('ajax')) {
            $query = $this->searchDataByCondition();
            $mProducts = $this->paginate($query);

            //header
            $exportCSV[] = [
                '仕入先マスタ',
                '仕入商品',
                '枝番',
                '商品ｺｰﾄﾞ',
                '商品名',
                '商品名索引',
                '単位',
                'ｾｯﾄ品区分',
                '在庫管理区分',
                '単価',
                '非課税区分',
                '商品カテゴリー',
                '内容'
            ];
            //content
            foreach ($mProducts as $key => $v) {
                $exportCSV[] = [
                    $v->m_supplier_id,
                    $v->m_supplier_product_id,
                    $v->edaban,
                    $v->koudo,
                    $v->mei,
                    $v->mei_sakuin,
                    $v->tani,
                    $v->setto_hinkubun,
                    $v->zaiko_kanri_kubun,
                    $v->tanka,
                    $v->hikazei_kubun,
                    $v->m_system_shouhin_kategori_id,
                    $v->naiyou
                ];
            }

            $this->exportCsvResponse(
                $exportCSV,
                '商品CSV出力_' . date("Ymd") . '.csv'
            );
        }
    }

    /**
     * CSV Import method
     *
     * @return
     * @throws \Exception
     */
    public function csvImport()
    {
        if ($this->request->is('ajax')) {
            list($status, $msg, $data) = $this->getCsvToArray($_FILES['file']);

            if($status === self::STATUS_SUCCESS) {
                //save multi record
                $fields = [
                    'm_supplier_id',
                    'm_supplier_product_id',
                    'edaban',
                    'koudo',
                    'mei',
                    'mei_sakuin',
                    'tani',
                    'setto_hinkubun',
                    'zaiko_kanri_kubun',
                    'juusho_3',
                    'tanka',
                    'm_system_shiiresaki_kategori_id',
                    'naiyou'
                ];

                $dataMProduct = [];
                foreach ($data as $values) {
                    $dataMProduct[] = array_combine($fields, $values);
                }
                $entities = $this->MProduct->newEntities($dataMProduct);
                if($this->MProduct->saveMany($entities)) {
                    $msg = Message::SAVED;
                }
            }
            echo json_encode([
                'msg' => $msg,
                'status' => $status,
            ]); die;
        }
    }

    public function formUpload()
    {
        if ($this->request->is('ajax')) {
            echo $this->render('../MSupplier/form_upload');
            die;
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function popup()
    {
        if ($this->request->is('ajax')) {
            $type = $this->request->getData('type');

            if ($type == self::SHOW_POPUP_PRODUCTS) {
                $mstSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_KATEGORI_ID]);
                $this->set(compact('mstSystem'));
                echo $this->render('popup');
                die;
            } else {
                $this->autoRender = false;
                $this->paginate = $this->getPaginateConfig();
                $this->paginate['order'] = $this->getQueryOrder();//order
                //get all param search
                $pArySearch = $this->getQuerySearch();

                if ($pArySearch) {

                    //like search condition
                    foreach (["koudo", "mei"] as $field) {
                        if ($strField = $this->validAryKey($pArySearch, $field)) {
                            $this->paginate['conditions']['MProduct.' . $field . ' LIKE'] = "%$strField%";
                        }
                    }

                    //= search condition
                    foreach (["bunrui_koudo", "m_system_shouhin_kategori_id"] as $field) {
                        if ($value = $this->validAryKey($pArySearch, $field)) {
                            $this->paginate['conditions']['MProduct.' . $field] = $value;
                        }
                    }

                }

                $query = $this->MProduct->find()
                    ->where(['MProduct.deleted is' => null]); //remove condition: 'MProduct.ekisei_zaiko_suuryou >' => 0
                $mProducts = $this->paginate($query);

                $result = [];
                foreach ($mProducts as $key => $mProduct) {
                    $intEkiseiZaikoSuuryou = $mProduct->ekisei_zaiko_suuryou;
                    $supplierId = $mProduct->m_supplier_id ?: OrderDetailTable::EKURASHI_KAISHA_ID;

                    $result[$key][] = $this->tableCheckboxField($mProduct);
                    $result[$key][] = $this->getSupplierName($supplierId).
                        '<input type="hidden" name="supplier_id[]" value="'.$supplierId.'" id="supplier_id-'.
                        $supplierId.'">'; //仕入先
                    $result[$key][] = $mProduct->koudo;//商品コード
                    $result[$key][] = $mProduct->mei;//商品名
                    $result[$key][] = $mProduct->naiyou;//内容
                    $result[$key][] = $this->validAryKey(MProductTable::TANI_VALUE, $mProduct->tani);//単位
                    $result[$key][] = $intEkiseiZaikoSuuryou;//数量
                    $result[$key][] = $mProduct->tanka;//発注単価
                    $result[$key][] = $mProduct->tanka * $intEkiseiZaikoSuuryou;//発注金額
                    $result[$key][] = $mProduct->hyoujun_uriage_tanka;//受注単価
                    $result[$key][] = $mProduct->hyoujun_uriage_tanka * $intEkiseiZaikoSuuryou;//受注金額
                    $result[$key][] = $mProduct->modified;
                }

                $this->datatableResponse($query, $result);
            }
        }
    }
}
