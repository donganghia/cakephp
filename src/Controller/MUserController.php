<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Controller;

use App\Libs\Crypt;
use App\Libs\Message;
use App\Libs\Utility;
use App\Model\Table\MUserTable;

class MUserController extends AppController
{

    /**
     * Type: action
     * Method: post|get
     */
    public function index()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;

            $this->paginate = $this->getPaginateConfig(); //limit && page
            $this->paginate['contain'] = ['MRole', 'MSupplier'];
            $this->paginate['order'] = $this->getQueryOrder(8);//order
            $this->paginate['sortWhitelist'] = [
                'MSupplier.mei_1', 'MRole.name', 'MUser.created', 'MUser.email', 'MUser.phone', 'MUser.type', 'MUser.name'];


            //get all param search
            $pArySearch = $this->getQuerySearch();

            //search
            if($pArySearch) {
                if($strUsername = $this->validAryKey($pArySearch, 'username')) {
                    $this->paginate['conditions']['MUser.username LIKE'] = "%$strUsername%";
                }
                if($strName = $this->validAryKey($pArySearch, 'name')) {
                    $this->paginate['conditions']['MUser.name LIKE'] = "%$strName%";
                }
                if($strEmail = $this->validAryKey($pArySearch, 'email')) {
                    $this->paginate['conditions']['MUser.email LIKE'] = "%$strEmail%";
                }
                if($strPhone = $this->validAryKey($pArySearch, 'phone')) {
                    $this->paginate['conditions']['MUser.phone LIKE'] = "%$strPhone%";
                }
                if($strType = $this->validAryKey($pArySearch, 'type')) {
                    $this->paginate['conditions']['MUser.type'] = $strType;
                }
            }
            $this->paginate['conditions']['MUser.id <>'] = self::$aryLoginUser['id'];

            $query = $this->MUser->find()->where(['MUser.deleted is' => null]);
            $mUser = $this->paginate($query);

            $aryResult = [];
            foreach ($mUser as $key => $mUserItem) {
                $aryResult[$key][] = $this->tableActionField($mUserItem->id, ['controller'=> 'MUser', 'action'=> 'edit'], ['controller'=> 'MUser', 'action'=> 'delete']);
                $aryResult[$key][] = $mUserItem->username;
                $aryResult[$key][] = $mUserItem->name;
                $aryResult[$key][] = MUserTable::TYPE_VALUE[$mUserItem->type];
                $aryResult[$key][] = isset($mUserItem->m_role) ? $mUserItem->m_role->name : '';
                $aryResult[$key][] = isset($mUserItem->m_supplier) ? $mUserItem->m_supplier->mei_1 : '';
                $aryResult[$key][] = $mUserItem->phone;
                $aryResult[$key][] = $mUserItem->email;
                $aryResult[$key][] = Utility::dateFull($mUserItem->created);
            }

            $this->datatableResponse($query, $aryResult);
        }
    }

    /**
     * Type: action
     * Method: post|get
     */
    public function add()
    {
        $mUser = $this->MUser->newEntity();
        if ($this->request->is('post')) {
            $aryData = $this->request->getData();
            $aryValidate['validate'] = 'Default';
            if($aryData['type'] == MUserTable::TYPE_E_KURASHI) {
                $aryData['m_supplier_id'] = null;
            } else {
                $aryValidate['validate'] = 'ForPartner';
            }

            $mUser = $this->MUser->patchEntity($mUser, $aryData, $aryValidate);

            if ($this->MUser->save($mUser)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }

            if($mUser->getErrors()) {
                $this->errorFlash($mUser->getErrors());
            }
        }
        $aryMRole = $this->MRole->find('list', ['order' => ['created' => 'DESC']])->where(['deleted is' => null])->toArray();
        $aryMSupplier = $this->MSupplier
            ->find('list', ['order' => ['created' => 'DESC'], 'keyField' => 'id', 'valueField' => 'mei_1'])
            ->where(['deleted is' => null])
            ->toArray();

        $this->set(compact('mUser', 'aryMRole', 'aryMSupplier'));
    }

    /**
     * Type: action
     * Method: post|patch|put
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function edit($id = null)
    {
        $id = Crypt::decryptAES($id);
        $mUser = $this->MUser->find()->where(['id' => $id, 'deleted is' => null])->first();
        if(!$mUser) {
            $this->errorFlash('利用者が見つかりません。');
            return $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $aryData = $this->request->getData();
            $aryValidate['validate'] = 'Default';
            if($aryData['type'] == MUserTable::TYPE_E_KURASHI) {
                $aryData['m_supplier_id'] = null;
            } else {
                $aryValidate['validate'] = 'ForPartner';
            }

            $mUser = $this->MUser->patchEntity($mUser, $aryData, $aryValidate);
            if ($this->MUser->save($mUser)) {
                $this->successFlash(Message::SAVED);

                return $this->redirect(['action' => 'index']);
            }

            if($mUser->getErrors()) {
                $this->errorFlash($mUser->getErrors());
            }
        }

        $aryMRole = $this->MRole->find('list', ['order' => ['created' => 'DESC']])->where(['deleted is' => null])->toArray();
        $aryMSupplier = $this->MSupplier
            ->find('list', ['order' => ['created' => 'DESC'], 'keyField' => 'id', 'valueField' => 'mei_1'])
            ->where(['deleted is' => null])
            ->toArray();

        $this->set(compact('mUser', 'aryMRole', 'aryMSupplier'));
    }

    /**
     * Type: action
     * Method: post|delete
     * @param null $id
     * @return \Cake\Http\Response|null
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['get']);
        $id = Crypt::decryptAES($id);
        $mUser = $this->MUser->find()->where(['id' => $id, 'deleted is' => null])->first();

        if(!$mUser) {
            $this->errorFlash('利用者が見つかりません。');
            return $this->redirect(['action' => 'index']);
        }

        $update = $this->MUser->updateAll(['deleted' => Utility::dbDate()], ['id' => $mUser->id]);
        if ($update) {
            $this->successFlash(Message::DELETED);
        } else {
            $this->errorFlash(Message::UNDELETED);
        }

        return $this->redirect(['action' => 'index']);
    }
}
