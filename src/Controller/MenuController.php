<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Controller;

use App\Controller\ProjectController;
use App\Libs\Utility;
use App\Model\Table\MSystemTable;
use App\Model\Table\MUserTable;
use App\Model\Table\ProjectTable;
use App\Model\Table\OrdersTable;
use Cake\Routing\Router;

class MenuController extends AppController
{

    public function main()
    {
        $obj = new ProjectController();
        if(self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) {
            $mstSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_TANTOUSHA]);
            $arySagyouAnken = $obj->getSagyouAnken();
            $aryOrderNotification = $this->_getOrderNotification([
                'OrderNotification.created >=' => date("Y-m-d", strtotime('-7 day'))
            ]);

            $this->set(compact('arySagyouAnken', 'mstSystem', 'aryOrderNotification'));
        }else if(self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER) {
            $countKakuninShoriIchiran = $obj->countKakuninShoriIchiran();
            $countMiKaitouIchiran = $obj->countMiKaitouIchiran();
            $aryOrderNotification = $this->_getOrderNotification([
                'OrderNotification.created >=' => date("Y-m-d", strtotime('-1 month')),
                'OrderNotification.m_user_id' => self::$aryLoginUser['id']
            ]);

            $this->set(compact('countKakuninShoriIchiran', 'countMiKaitouIchiran', 'aryOrderNotification'));
        }
    }

    /**
     *  ekurashi ajax get order notification
     *
     * @return void
     */
    public function getOrderNotification()
    {
        if($this->request->is('ajax')) {
            $tantouId = $this->getRequest()->getData('m_system_tantou_id');
            $condition = ['OrderNotification.created >=' => date("Y-m-d", strtotime('-7 day'))];
            $aryResult = $this->_getOrderNotification($tantouId ?
                array_merge($condition, ['m_system_tantou_id' => $tantouId]) : $condition);
            $this->jsonResponse($aryResult);
        }
    }

    private function _getOrderNotification($condition = [])
    {
        $aryData = $this->OrderNotification->find()
            ->where($condition)
            ->orderDesc('OrderNotification.created')
            ->toArray();

        //add link url
        if(!empty($aryData) && self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI) {
            foreach ($aryData as &$v) {
                $v['href'] = Router::url(['controller' => 'Project', 'action' => 'ankenHenshuu', $this->encrypAES($v['order_id'])]);
            }
        }
        return $aryData;
    }

    public function mHoshuTouroku()
    {
        $intProduct = $this->MstService->cntProduct();
        $intSupplier = $this->MstService->cntSupplier();
        $intCustomer = $this->MstService->cntCustomer();

        $this->set(compact('intProduct', 'intSupplier', 'intCustomer'));
    }

    public function mKanryouKeijouShori()
    {
    }

    public function juchuuTouroku()
    {
        $this->loadProjectList([
            //'Project.type' => ProjectTable::YOTEI_TYPE,
            'Orders.status' => OrdersTable::STATUS_TEMP
        ]);
    }

    public function shisutemuKanri()
    {
    }

    private function loadProjectList($aryCondition = [])
    {
        if ($this->request->is('ajax')) {
            $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_BUMON_ID]]);

            $this->autoRender = false;

            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder();//order
            $this->paginate['contain'] = ['Project'];
            $this->paginate['sortWhitelist'] = [
                'Orders.juchuu_bangou', 'Orders.modified',
                'Project.e_moushisha_mei', 'Project.m_system_bumon_id'
            ];

            $query = $this->Orders->find()->where([
                'Orders.deleted is' => null
            ]);
            //一時保存
            $this->paginate['conditions'] = $aryCondition;

            $objOrders = $this->paginate($query);

            $result = [];
            foreach ($objOrders as $key => $objOrderItem) {
                $aryProject = $objOrderItem->project;
                $strUrlEdit = ($aryProject['type'] == ProjectTable::YOTEI_TYPE) ? 'yoteiHenshuu' : 'kakuteiHenshuu';
                $bumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]) ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]: '';

                $result[$key][] = $this->tableActionField($objOrderItem->id, [
                    'controller' => 'Project',
                    'action' => $strUrlEdit
                ]);
                $result[$key][] = $objOrderItem->juchuu_bangou;
                $result[$key][] = $aryProject['e_moushisha_mei'];
                $result[$key][] = $bumon;
                $result[$key][] = Utility::dateFull($objOrderItem->modified);
            }

            $this->datatableResponse($query, $result);
        }
    }
}
