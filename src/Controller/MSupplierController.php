<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Libs\Crypt;
use App\Model\Table\MSystemTable;
use PHP_CodeSniffer\Reports\Json;
use App\Libs\Message;
/**
 * MSupplier Controller
 *
 * @property \App\Model\Table\MSupplierTable $MSupplier
 *
 * @method \App\Model\Entity\MSupplier[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MSupplierController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN,
            MSystemTable::SYSTEM_KATEGORI_ID, MSystemTable::SYSTEM_KYOJUU_ARIA]]);

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder(0);//order

            $query = $this->searchDataByCondition();
            $msuppliers = $this->paginate($query);

            $fields = [
                "id",
                "koudo",
                "mei_1",
                "mei_2",
                "ryakushou",
                "yuubenbangou",
                "juusho_1",
                "juusho_2",
                "m_system_shiiresaki_kategori_id",
                "juusho_3",
                "modified"
            ];
            $result = [];
            foreach ($msuppliers as $key => $msupplier) {
                $result[$key][] = $this->tableActionField($msupplier->id, ['controller' => 'MSupplier', 'action' => 'edit']);
                foreach ($fields as $f) {
                    if ($f == "id") continue;
                    elseif ($f == "m_system_shiiresaki_kategori_id") {
                        $result[$key][] = isset($mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$msupplier->{$f}])
                            ? $mstSystem[MSystemTable::SYSTEM_KATEGORI_ID][$msupplier->{$f}] : null;
                    } else
                    $result[$key][] = $msupplier->{$f};
                }
            }

            $this->datatableResponse($query, $result);
        }

        $this->set(compact('mstSystem'));
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
        //search
        if ($pArySearch) {
            //like search condition
            foreach (["koudo", "mei_1", "mei_2", "ryakushou", "yuubenbangou", "juusho_1", "juusho_2"] as $field) {
                if ($strField = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']['MSupplier.' . $field . ' LIKE'] = "%$strField%";
                }
            }
            //= search condition
            if ($value = $this->validAryKey($pArySearch, 'm_system_shiiresaki_kategori_id')) {
                $this->paginate['conditions']['MSupplier.m_system_shiiresaki_kategori_id'] = $value;
            }
        }

        return $this->MSupplier->find()->where(['MSupplier.deleted is' => null]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $mSupplier = $this->MSupplier->newEntity();
        if ($this->request->is('post')) {
            $mSupplier = $this->MSupplier->patchEntity($mSupplier, $this->request->getData());
            if ($this->MSupplier->save($mSupplier)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }
            if ($mSupplier->getErrors()) {
                $this->errorFlash($mSupplier->getErrors());
            }
        }
        $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN,
            MSystemTable::SYSTEM_KATEGORI_ID, MSystemTable::SYSTEM_KYOJUU_ARIA]]);
        $this->set(compact('mSupplier', 'mstSystem'));
    }

    /**
     * Edit method
     *
     * @param string|null $id M Supplier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $id = Crypt::decryptAES($id);
        $mSupplier = $this->MSupplier->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mSupplier = $this->MSupplier->patchEntity($mSupplier, $this->request->getData());
            if ($this->MSupplier->save($mSupplier)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }

            if ($mSupplier->getErrors()) {
                $this->errorFlash($mSupplier->getErrors());
            }
        }
        $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_SHIHARAI_SAKI_KUBUN,
            MSystemTable::SYSTEM_KATEGORI_ID, MSystemTable::SYSTEM_KYOJUU_ARIA]]);
        $this->set(compact('mSupplier', 'mstSystem'));
    }

    /**
     * Delete method
     *
     * @param string|null $id M Supplier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mSupplier = $this->MSupplier->get($id);
        if ($this->MSupplier->delete($mSupplier)) {
            $this->Flash->success(__('The m supplier has been deleted.'));
        } else {
            $this->Flash->error(__('The m supplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
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
            $msuppliers = $this->paginate($query);

            //header
            $exportCSV[] = [
                '仕入先ｺｰﾄﾞ',
                '仕入先名１',
                '仕入先名2',
                '仕入先名略称',
                '仕入先名索引',
                '郵便番号',
                'エリア',
                '住所１',
                '住所2',
                '住所3',
                'カスタマバーコード',
                '電話番号',
                'ＦＡＸ番号',
                'カテゴリーｺｰﾄﾞ',
                '支払先区分',
                '担当者ｺｰﾄﾞ',
                '相手先担当者名',
                '相手先担当者名',
                '特記・備考'
            ];
            //content
            foreach ($msuppliers as $key => $v) {
                $exportCSV[] = [
                    $v->koudo,
                    $v->mei_1,
                    $v->mei_2,
                    $v->ryakushou,
                    $v->sakuin,
                    $v->yuubenbangou,
                    $v->area,
                    $v->juusho_1,
                    $v->juusho_2,
                    $v->juusho_3,
                    $v->kasutama_bakoudo,
                    $v->denwa,
                    $v->fax,
                    $v->m_system_shiiresaki_kategori_id,
                    $v->shiharai_saki_kubun,
                    $v->m_system_tantousha_id,
                    $v->hiire_tanka_settei_kubun,
                    $v->aitesaki_tantousha_mei,
                    $v->bikou
                ];
            }

            $this->exportCsvResponse(
                $exportCSV,
                '仕入先CSV出力_' . date("Ymd") . '.csv'
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
                    'koudo',
                    'mei_1',
                    'mei_2',
                    'ryakushou',
                    'sakuin',
                    'yuubenbangou',
                    'area',
                    'juusho_1',
                    'juusho_2',
                    'juusho_3',
                    'kasutama_bakoudo',
                    'denwa',
                    'fax',
                    'm_system_shiiresaki_kategori_id',
                    'shiharai_saki_kubun',
                    'm_system_tantousha_id',
                    'hiire_tanka_settei_kubun',
                    'aitesaki_tantousha_mei',
                    'bikou'
                ];

                $dataSupplier = [];
                foreach ($data as $values) {
                    $dataSupplier[] = array_combine($fields, $values);
                }
                $entities = $this->MSupplier->newEntities($dataSupplier);
                if($this->MSupplier->saveMany($entities)) {
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
            echo $this->render('form_upload');
            die;
        }
    }

}
