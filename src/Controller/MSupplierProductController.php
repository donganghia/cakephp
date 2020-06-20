<?php
namespace App\Controller;

use App\Model\Table\MProductTable;
use App\Model\Table\MSupplierProductTable;
use App\Libs\Message;
/**
 * MSupplierProduct Controller
 *
 * @property \App\Model\Table\MSupplierProductTable $MSupplierProduct
 *
 * @method \App\Model\Entity\MSupplierProduct[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MSupplierProductController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder(0);//order

            //get all param search
            $pArySearch = $this->getQuerySearch();

            //search
            if($pArySearch) {
                //= search condition
                if($value = $this->validAryKey($pArySearch, 'm_supplier_id')) {
                    $this->paginate['conditions']['MSupplierProduct.m_supplier_id'] = $value;
                }
            }

            $query = $this->MSupplierProduct->find()->where(['MSupplierProduct.deleted is' => null]);
            $msupplierProducts = $this->paginate($query);

            $result = [];
            foreach ($msupplierProducts as $key => $msupplierProduct) {
                $result[$key][] = $this->buttonAjaxAction($msupplierProduct->id);
                $result[$key][] = $msupplierProduct->shouhin_koudo;
                $result[$key][] = $msupplierProduct->shouhin_mei;

                // $result[$key][] = $msupplierProduct->bunrui_koudo;
                $result[$key][] = isset(MProductTable::BUNRUI_KOUDO_VALUE[$msupplierProduct->bunrui_koudo])
                    ? MProductTable::BUNRUI_KOUDO_VALUE[$msupplierProduct->bunrui_koudo] : null;

                // $result[$key][] = $msupplierProduct->tanka_shubetsu;
                $result[$key][] = isset(MSupplierProductTable::TANKA_SHUBETSU[$msupplierProduct->tanka_shubetsu])
                ? MSupplierProductTable::TANKA_SHUBETSU[$msupplierProduct->tanka_shubetsu] : null;

                $result[$key][] = $msupplierProduct->tanka;
                $result[$key][] = $msupplierProduct->modified;
            }

            $this->datatableResponse($query, $result);
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');
            $mSupplierProduct =  $id == 0
                ? $this->MSupplierProduct->newEntity()
                : $this->MSupplierProduct->get($id, [
                    'contain' => []
                ]);
            if($id == 0)
                $mSupplierProduct->m_supplier_id = $this->request->getData('m_supplier_id');

            $mstSystem = $this->getMstSystem(['MSystem.type_name' => 'SHIHARAI_SAKI_KUBUN']);
            $this->set(compact('mSupplierProduct', 'mstSystem'));

            echo $this->render('add'); die;
        }
    }

    public function save()
    {
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');

            $mSupplierProduct = $id == 0
                ? $this->MSupplierProduct->newEntity()
                : $this->MSupplierProduct->get($id, [
                    'contain' => []
                ]) ;
            $mSupplierProduct = $this->MSupplierProduct->patchEntity($mSupplierProduct, $this->request->getData());
            if ($this->MSupplierProduct->save($mSupplierProduct)) {
                echo json_encode([
                    'msg' => __(Message::SAVED),
                    'status' => self::STATUS_SUCCESS
                ]); die;
            }
            echo json_encode([
                'msg' => __(Message::UNSAVED),
                'status' => self::STATUS_ERROR
            ]); die;
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id M Supplier Product id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete( )
    {
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');
            $mSupplierProduct = $this->MSupplierProduct->get($id);
            if ($this->MSupplierProduct->delete($mSupplierProduct)) {
                echo json_encode([
                    'msg' => __('The m supplier product has been deleted.'),
                    'status' => self::STATUS_SUCCESS
                ]);
            } else {
                echo json_encode([
                    'msg' => __('The m supplier product could not be deleted. Please, try again.'),
                    'status' => self::STATUS_ERROR
                ]);
            }
            die;
        }
    }

    /**
     * CSV Export method
     *
     * return json
     */
    public function csvExport()
    {
        if ($this->request->is('ajax')) {
            $query = $this->MSupplierProduct->find()
                ->where([
                    'MSupplierProduct.deleted is' => null,
                    'MSupplierProduct.m_supplier_id is' => $this->request->getData('m_supplier_id')
                    ])
                ->order(['MSupplierProduct.modified' => 'DESC']);
            $msupplierProducts = $this->paginate($query);

            //header
            $exportCSV[] = [
                '仕入先マスタ',
                '単価ﾏｽﾀｰ区分',
                '単価種類',
                '商品名',
                '分類ｺｰﾄ',
                '単価種別',
                '単価'
            ];
            //content
            foreach ($msupplierProducts as $key => $v) {
                $exportCSV[] = [
                    $v->m_supplier_id,
                    $v->tanka_masuta_kubun,
                    $v->tanka_shurui,
                    $v->shouhin_mei,
                    $v->bunrui_koudo,
                    $v->tanka_shubetsu,
                    $v->tanka
                ];
            }

            $this->exportCsvResponse($exportCSV, '仕入商品');
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
                    'tanka_masuta_kubun',
                    'tanka_shurui',
                    'shouhin_mei',
                    'bunrui_koudo',
                    'tanka_shubetsu',
                    'tanka'
                ];

                $dataSupplierProduct = [];
                foreach ($data as $values) {
                    $dataSupplierProduct[] = array_combine($fields, $values);
                }

                $entities = $this->MSupplierProduct->newEntities($dataSupplierProduct);

                try {
                    if ($result = $this->MSupplierProduct->saveMany($entities)) {
                        $msg = Message::SAVED;
                    } else $msg = Message::UNSAVED;
                } catch (Exception $e) {
                    $msg = Message::UNSAVED;
                }
            }
            echo json_encode([
                'msg' => $msg,
                'status' => $status,
            ]); die;
        }
    }

}
