<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Libs\Constant;
use App\Libs\Message;
use App\Libs\Utility;
use App\Model\Entity\OrderDetail;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;
use App\Model\Table\MUserTable;
use App\Model\Table\OrderDetailTable;
use App\Model\Table\ProjectTable;
use App\Model\Table\OrdersTable;
use Cake\Datasource\ConnectionManager;
use App\Libs\Crypt;

class ProjectController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $intDefaultTax = 8;

        $this->set(compact('intDefaultTax'));
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function yoteiIchiran()
    {
        $mstSystem = $this->getMstSystem([
            'MSystem.type_name IN' => [
                MSystemTable::SYSTEM_TANTOUSHA,
                MSystemTable::SYSTEM_BUMON_ID
            ]
        ]);

        $arySupplier = $this->getMstSupplier();

        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();

            if ($value = $this->validAryKey($this->getQuerySearch(), 'm_supplier_id')) {
                $this->joinWithOrderDetail([
                    'OrderDetail.m_supplier_id' => $value
                ], $query);
            }
            $objOrders = $this->paginate($query);
            $result = [];
            foreach ($objOrders as $key => $objOrderItem) {
                $aryProject = $objOrderItem->project;
                $strUrlEdit = ($aryProject['type'] == ProjectTable::YOTEI_TYPE) ? 'yoteiHenshuu' : 'kakuteiHenshuu';
                $bumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']])
                    ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]
                    : '';

                $result[$key][] = $this->tableActionField($objOrderItem->id, [
                    'controller' => 'Project',
                    'action' => $strUrlEdit
                ]);
                $result[$key][] = $objOrderItem->juchuu_bangou;
                $result[$key][] = $aryProject['e_moushisha_mei'];
                $result[$key][] = $bumon;
                $result[$key][] = $aryProject['e_moushisha_yuubenbangou'];
                $result[$key][] = $aryProject['e_moushisha_juushotodoufuken'];
                $result[$key][] = $aryProject['e_moushisha_juushoshichou'];
                $result[$key][] = Utility::dateFull($objOrderItem->modified);
            }

            $this->datatableResponse($query, $result);
        }

        $this->set(compact('mstSystem', 'arySupplier'));
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function juchuuSumiIchiran()
    {
        return $this->yoteiIchiran();
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function kakuninShoriIchiran()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();
            $this->joinWithOrderDetail($this->kakuninShoriIchiranCondition(), $query);
            $objOrders = $this->paginate($query);

            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }

        $defaultCondition = $this->partnerDefaultCondition();
        $this->set(compact('defaultCondition'));
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function kanryouKeijouShoriIchiran()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();
            $objOrders = $this->paginate($query);

            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }

        $completed = ['Project.type'  => ProjectTable::KAKUTEI_TYPE,
            'Orders.m_system_joutaikubun_id_in' => OrderDetailTable::JOUTAI_KUBUN_NOUHIN_KANRYOU .",". OrderDetailTable::JOUTAI_KUBUN_SAGYOU_KANRYOU];
        $processing = ['Project.type'  => ProjectTable::KAKUTEI_TYPE,
            'Orders.m_system_joutaikubun_id_in' => OrderDetailTable::JOUTAI_KUBUN_NOUHIN_KANRYOU .",". OrderDetailTable::JOUTAI_KUBUN_SAGYOU_KANRYOU.','.OrderDetailTable::JOUTAI_KUBUN_IKKATSU_KEIJOU .",". OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU
                .",". OrderDetailTable::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI];

        $this->set(compact('completed', 'processing'));
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function kanryouZumiMiKeijouIchiran()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();
            $objOrders = $this->paginate($query);

            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }
    }

    /**
     * Desc: array search
     * Type: action
     * Method: get
     * @param array $search
     * @param array $source
     *
     * @return array
     */
    public function convertJoutaiNametoId($search, $source)
    {
        $str = '';
        foreach ($search as $_search) {
            if($id = array_search($_search, $source)) {
                $str .= $id.",";
            }
        }
        return $str != '' ? substr($str,0,-1) : '';
    }

    /**
     * Desc: 案件未確認
     * Type: action
     * Method: get
     */
    public function kakuninShoriIchiranCondition()
    {
        $orderDetailCondition = [
            'OrderDetail.m_supplier_id' => self::$aryLoginUser['m_supplier_id'],
            'OrderDetail.status' => OrderDetailTable::STATUS_WAIT_CONFIRM
        ];
        if ($value = $this->validAryKey($this->getQuerySearch(), 'nouki_kaishibi')) {
            $orderDetailCondition['nouki_kaishibi >='] = $value;
        }
        return $orderDetailCondition;
    }

    /**
     * @return int|null
     */
    public function countKakuninShoriIchiran()
    {
        $query = $this->Orders->find()->contain(['Project'])
            ->where($this->partnerDefaultCondition(true));
        $this->joinWithOrderDetail($this->kakuninShoriIchiranCondition(), $query);

        return $query->count();
    }

    /**
     * @return array
     */
    public  function getSagyouAnken()
    {
        $aryData = $this->Orders->find()->contain(['Project'])->select(['Orders.id', 'Project.nouki_kaishibi'])
            ->where(array_merge($this->partnerDefaultCondition(true),
                ['Project.nouki_kaishibi >=' => date("Y-m-d"),
                    'Project.nouki_kaishibi <=' => date("Y-m-d", strtotime('+2days'))]))
            ->toArray();

        $calculation = [date("Ymd") => 0, date("Ymd", strtotime('+1 days')) => 0, date("Ymd",strtotime('+2 days')) => 0];
        if(!empty($aryData)) {
            foreach ($aryData as $data) {
               $calculation[date("Ymd", strtotime($data->project->nouki_kaishibi))] ++;
            }
        }
        return [ 'honjitsu' => $calculation[date("Ymd")],
                'ashita' => $calculation[date("Ymd", strtotime('+1 days'))],
                'asatte' => $calculation[date("Ymd", strtotime('+2 days'))] ];
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function ankenKensakuIchiran()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();
            $this->joinWithOrderDetail($this->ankenKensakuIchiranCondition(), $query);
            $objOrders = $this->paginate($query);

            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }

        $defaultCondition = $this->partnerDefaultCondition();
        $this->set(compact('defaultCondition'));
    }

    /**
     * Type: action
     * Method: build condition
     */
    public function ankenKensakuIchiranCondition()
    {
        $condition = [
            'OrderDetail.m_supplier_id' => self::$aryLoginUser['m_supplier_id'],
            'OrderDetail.status  <>' => OrderDetailTable::STATUS_RETURN,
            'OrderDetail.status  <>' => OrderDetailTable::STATUS_FINISH
        ];

        if ($aryJoutai = $this->validAryKey($this->getQuerySearch(), 'joutai_opushon')) {
            foreach ($aryJoutai as $data) {
                switch ($data) {
                    case 0: //案件未確認
                        $condition['or'][] = $this->kakuninShoriIchiranCondition();
                        break;
                    case 1: //予定日未確定
                        $condition['or'][] = $this->miKaitouIchiranCondition();
                        break;
                    case 2: //作業未完了
                        $condition['or'][] = $this->ankenKanryouTourokuCondition();
                        break;
                    case 3: //完了未報告
                        break;
                    case 4: //完了報告済み
                        break;
                }
            }
        }

        return $condition;
    }

    /**
     * @param : $objOrders
     * @param bool $isEdit
     * @return array
     */
    public function getAryOrders($objOrders, $isEdit = true)
    {
        $result = [];
        $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_BUMON_ID, MSystemTable::SYSTEM_JOUTAI_KUBUN]]);
        foreach ($objOrders as $key => $objOrderItem) {
            $aryProject = $objOrderItem->project;
            $result[$key][] = $isEdit ? $this->tableActionField($objOrderItem->id, [
                'controller' => 'Project',
                'action' => $this->getShoriAction($aryProject)
            ]) : null;
            $bumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]) ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]: '';
            $result[$key][] = $objOrderItem->juchuu_bangou;
            $result[$key][] = $aryProject['e_moushisha_mei'];
            $result[$key][] = $bumon;
            $result[$key][] = $this->getItemDate($objOrderItem);
        }

        return $result;
    }

    /**
     * @param $aryProject
     * Method: getShoriAction
     * @return string
     */
    public function getShoriAction($aryProject)
    {
        $editUrl = null;
        switch ($this->request->getParam('action')) {
            case 'kakuninShoriIchiran':
            case 'miKaitouIchiran':
                $editUrl = 'kakuninShori';
                break;
            case 'ankenKanryouTouroku':
                $editUrl = 'ankenKanryouShori';
                break;
            case 'ankenKensakuIchiran':
                $editUrl = isset($aryProject->m_system_joutaikubun_id) &&
                    $aryProject->m_system_joutaikubun_id == OrderDetailTable::JOUTAI_KUBUN_KAKUNINZU ? 'ankenKanryouShori' : 'kakuninShori';
                break;
            case 'kanryouKeijouShoriIchiran':
            case 'kanryouZumiMiKeijouIchiran':
                $editUrl = 'kanryouKeijouShori';
                break;
            case 'ankenKensaku':
                $editUrl = 'ankenHenshuu';
                break;
            case 'kizonHenshuuIchiran':
                $editUrl = 'kizonHenshuu';
                break;
        }

        return $editUrl;
    }

    /**
     * @param $objOrderItem
     * Method: getShoriAction
     * @return string
     */
    public function getItemDate($objOrderItem)
    {
        $date = null;
        switch ($this->request->getParam('action')) {
            case 'kanryouKeijouShoriIchiran':
            case 'kanryouZumiMiKeijouIchiran':
                $date = Utility::dateFull($objOrderItem->nouki_shuuryoubi);
                break;
            default:
                $date = Utility::dateFull($objOrderItem->modified);
                break;
        }

        return $date;
    }
    /**
     * Type: action
     * Method: get(ajax)
     */
    public function ankenKanryouTouroku()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();

            $this->joinWithOrderDetail($this->ankenKanryouTourokuCondition(), $query);

            $objOrders = $this->paginate($query);
            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }

        $defaultCondition = $this->partnerDefaultCondition();
        $this->set(compact('defaultCondition'));
    }

    /**
     * 作業未完了
    */
    public function ankenKanryouTourokuCondition()
    {
        $orderDetailCondition = [
            'OrderDetail.m_supplier_id' => self::$aryLoginUser['m_supplier_id'],
            'OrderDetail.status' => OrderDetailTable::STATUS_CONFIRM,
            'OrderDetail.nouki_kaishibi is not' => null
        ];
        if ($value = $this->validAryKey($this->getQuerySearch(), 'nouki_kaishibi')) {
            $orderDetailCondition['nouki_kaishibi >='] = $value;
        }

        return $orderDetailCondition;
    }

    /**
     * partnerDefaultCondition
     */
    public static function partnerDefaultCondition($prefix = false)
    {
        return $prefix
            ?
            ['Orders.status' => OrdersTable::STATUS_REGISTER,
                'Project.type' => ProjectTable::KAKUTEI_TYPE]
            :
            ['status' => OrdersTable::STATUS_REGISTER,
                'type' => ProjectTable::KAKUTEI_TYPE];
    }

    /**
     * joinWithOrderDetail
     */
    private function joinWithOrderDetail($condition, &$query)
    {
        $query->innerJoinWith('OrderDetail', function ($q) use ($condition) {
            return $q->where($condition);
        })->group('OrderDetail.order_id');
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function miKaitouIchiran()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->searchDataByCondition();
            $this->joinWithOrderDetail($this->miKaitouIchiranCondition(), $query);
            $objOrders = $this->paginate($query);
            $this->datatableResponse($query, $this->getAryOrders($objOrders));
        }
        $defaultCondition = $this->partnerDefaultCondition();
        $this->set(compact('defaultCondition'));
    }

    public  function countMiKaitouIchiran()
    {
        $query = $this->Orders->find()->contain(['Project'])
            ->where($this->partnerDefaultCondition(true));
        $this->joinWithOrderDetail($this->miKaitouIchiranCondition(), $query);

        return $query->count();
    }

    /**
     * Desc: 予定日未確定
     * Type: action
     * Method: get(ajax)
     */
    public function miKaitouIchiranCondition()
    {
        $orderDetailCondition = [
            'OrderDetail.status' => OrderDetailTable::STATUS_CONFIRM,
            'OrderDetail.nouki_kaishibi is' => null];
        if(self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER) {
            $orderDetailCondition['OrderDetail.m_supplier_id'] = self::$aryLoginUser['m_supplier_id'];
        }

        if ($value = $this->validAryKey($this->getQuerySearch(), 'nouki_kaishibi')) {
            $orderDetailCondition['OrderDetail.nouki_kaishibi >='] = $value;
        }

        return $orderDetailCondition;
    }
    /**
     * Search Condition method
     *
     * @return object
     */
    public function searchDataByCondition()
    {
        $this->paginate = $this->getPaginateConfig();
        $this->paginate['order'] = $this->getQueryOrder();//order
        $this->paginate['contain'] = ['Project'];
        $this->paginate['sortWhitelist'] = [
            'Orders.juchuu_bangou', 'Orders.modified',
            'Project.e_moushisha_mei', 'Project.m_system_tantousha_id', 'Project.m_system_bumon_id',
            'Project.e_moushisha_yuubenbangou', 'Project.e_moushisha_juushotodoufuken', 'Project.e_moushisha_juushoshichou'
        ];

        //get all param search
        $pArySearch = $this->getQuerySearch();

        //search
        if ($pArySearch) {
            //like search condition
            foreach (['bangou', 'e_moushisha_mei'] as $field) {
                if ($strField = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']["Project.$field LIKE"] = "%$strField%";
                }
            }
            //= search condition
            foreach (['m_system_tantousha_id', 'm_system_bumon_id', 'type'] as $field) {
                if ($value = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']["Project.$field"] = $value;
                }
            }

            if ($value = $this->validAryKey($pArySearch, 'status')) {
                $this->paginate['conditions']["Orders.status"] = $value;
            }

            if ($value = $this->validAryKey($pArySearch, 'juchuu_bangou')) {
                $this->paginate['conditions']["Orders.juchuu_bangou LIKE"] = "%$value%";
            }

            if ($value = $this->validAryKey($pArySearch, 'created_from')) {
                $this->paginate['conditions']['Orders.created >='] = $value;
            }
            if ($value = $this->validAryKey($pArySearch, 'created_to')) {
                $this->paginate['conditions']['Orders.created <='] = $value;
            }

            if ($value = $this->validAryKey($pArySearch, 'bangou_from')) {
                $this->paginate['conditions']['Project.bangou >='] = $value;
            }
            if ($value = $this->validAryKey($pArySearch, 'bangou_to')) {
                $this->paginate['conditions']['Project.bangou <='] = $value;
            }

            //受注日
            if ($value = $this->validAryKey($pArySearch, 'juchuu_from')) {
                $this->paginate['conditions']['Orders.created >='] = $value;
            }
            if ($value = $this->validAryKey($pArySearch, 'juchuu_to')) {
                $this->paginate['conditions']['Orders.created <='] = $value;
            }

            //作業完了案件一覧, 完了済み未計上一覧
            if ($value = $this->validAryKey($pArySearch, 'Orders.m_system_joutaikubun_id_in')) {
                $this->paginate['conditions']['Orders.m_system_joutaikubun_id in'] =
                    !is_array($value) ? explode(",", $value) : $value;
            }

            if ($value = $this->validAryKey($pArySearch, 'Project.type')) {
                $this->paginate['conditions']['Project.type'] = $value;
            }

            if ($value = $this->validAryKey($pArySearch, 'nouki_shuuryoubi')) {
                $this->paginate['conditions']['Orders.nouki_shuuryoubi'] = $value;
            }
        }

        return $this->Orders->find()->where(['Orders.deleted is' => null]);
    }

    /**
     * @param  $params
     * Type: action
     * Method: get|post
     */
    public function getOrderDetailJoutaiKubun(&$params)
    {
        $currentAction = $this->request->getParam('action');
        $aryMSystem = $this->getMstSystem(['MSystem.type_name' => MSystemTable::SYSTEM_JOUTAI_KUBUN]);
        $statusCode = null;
        $statusName = null;
        $sub = '';

        //一括計上, 分割計上, 完了確認のみ, 繰上計上
        if (isset($params['order']['m_system_joutaikubun_id']) &&
            in_array($params['order']['m_system_joutaikubun_id'], [
                OrderDetailTable::JOUTAI_KUBUN_IKKATSU_KEIJOU,
                OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU,
                OrderDetailTable::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI,
                OrderDetailTable::JOUTAI_KUBUN_KURIGAMI_KEIJOU,
            ]))
        {
            $statusCode = $params['order']['m_system_joutaikubun_id'];
            if($statusCode === OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU &&
                isset($params['order_detail']['keijou'] ) && $params['order_detail']['keijou'] == OrderDetailTable::KEIJOU_IS_CHECKED) {
                $sub = OrderDetailTable::SUB_KEIJOU_SUMI;
            }
        }
        //見積依頼中
        else if (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['project']['type'] == ProjectTable::YOTEI_TYPE &&
            $params['order']['shori_joukyou'] ==  OrdersTable::SHORI_JOUKYOU_MITSUMORI_CHUU )
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_MITSUMORI_IRAI_CHUU;
        //見積提出
        } elseif (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['project']['type'] == ProjectTable::YOTEI_TYPE &&
            $params['order']['shori_joukyou'] ==  OrdersTable::SHORI_MISTUMORI  )
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_MITSUMORI_TEISHUTSU;
            if(isset($params['order']['seikan']) && $params['order']['seikan'] == 1) {
                $sub = OrderDetailTable::SUB_MITSUMORI_TEISHUTSU_SEIKAN;
            }
        //キャンセル
        } elseif (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['project']['type'] == ProjectTable::YOTEI_TYPE &&
            $params['order']['shori_joukyou'] ==  OrdersTable::SHORI_KYANSERY  )
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_KYANSERU;
        //失注
        } elseif (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['project']['type'] == ProjectTable::YOTEI_TYPE &&
            $params['order']['shori_joukyou'] ==  OrdersTable::SHORI_CHUU_SHITSU  )
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_SHITSU_CHUU;
        //受注済
        } elseif (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['order']['status'] == OrdersTable::STATUS_TEMP &&
            $params['project']['type'] == ProjectTable::KAKUTEI_TYPE)
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_JUCHUU_SUMI;
        //発注済
        } elseif (
            self::$aryLoginUser['type'] == MUserTable::TYPE_E_KURASHI &&
            $params['order']['status'] == OrdersTable::STATUS_REGISTER &&
            $params['project']['type'] == ProjectTable::KAKUTEI_TYPE)
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_HATCHUU_SUMI;
        //発注済　ー　戻し
        } elseif (
            $currentAction == 'kakuninShori' &&
            self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER &&
            $params['order_detail']['status'] ==  OrderDetailTable::STATUS_RETURN &&
            $params['project']['type'] == ProjectTable::KAKUTEI_TYPE)
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_HATCHUU_SUMI;
            $sub = OrderDetailTable::SUB_HATCHU_SUMI_MODOSHI;
        } elseif (
            $currentAction == 'kakuninShori' &&
            self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER &&
            $params['order_detail']['status'] ==  OrderDetailTable::STATUS_CONFIRM &&
            $params['project']['type'] == ProjectTable::KAKUTEI_TYPE)
        {
            $statusCode = OrderDetailTable::JOUTAI_KUBUN_KAKUNINZU;
        //作業完了 and 納品完了
        } elseif (
            $currentAction == 'ankenKanryouShori' &&
            self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER &&
            $params['order_detail']['status'] ==  OrderDetailTable::STATUS_FINISH &&
            $params['project']['type'] == ProjectTable::KAKUTEI_TYPE)
        {
            if(isset($params['order_detail']['shori_joukyou'])) {
                $statusCode = $params['order_detail']['shori_joukyou'] == OrderDetailTable::NOUHIN_KANRYOU
                    ? OrderDetailTable::JOUTAI_KUBUN_NOUHIN_KANRYOU
                    : OrderDetailTable::JOUTAI_KUBUN_SAGYOU_KANRYOU;
            }
        }
        //set m_system_joutaikubun_id
        if($statusCode != null) {
            $statusName = $aryMSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN][$statusCode];
            // compare  m_system_joutaikubun_id old with $statusCode
            if(!isset($params['order_detail']['m_system_joutaikubun_id']) ||
                $params['order_detail']['m_system_joutaikubun_id'] != $statusCode) {
                $params['order_notification']['title'] =  $statusName.$sub;
            }

            $params['order_detail']['m_system_joutaikubun_id'] =  $statusCode;
            $params['order']['m_system_joutaikubun_id'] =  $statusCode;

            //set 開始日 納期日
            if(isset($params['order_detail']['nouki_kaishibi'])) {
                $params['order']['nouki_kaishibi'] =  is_array($params['order_detail']['nouki_kaishibi'])
                   ? min($params['order_detail']['nouki_kaishibi']) : $params['order_detail']['nouki_kaishibi'];
            }
            $params['order']['nouki_shuuryoubi'] =  is_array($params['order_detail']['nouki_shuuryoubi'])
                ? max($params['order_detail']['nouki_shuuryoubi']) : $params['order_detail']['nouki_shuuryoubi'];

            //for 利用状況管理: 案件操作履歴
            $params['log_update_project']['title'] =  $statusName.$sub;
        }
    }

    /**
     * Type: action
     * Method: get|post
     */
    public function yoteiTouroku($customer_decrypted = null)
    {
        $msgSaved = '';
        $aryAttached = $aryError = [];
        $strTempoToken = Utility::genToken();
        $mstSystem = $this->getMstSystem($this->generateConditionForTouroku());
        $aryMediation = $this->MstService->getGensen();

        $project = $this->Project->newEntity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $params = $this->request->getData();

            $this->getOrderDetailJoutaiKubun($params);
            $project = $this->Project->patchEntity($project, $params['project']);
            $strTempoToken = $this->request->getData('tempo_token');
            $aryAttached = $this->request->getData('attached', []);
            $intOldProjectId = $this->request->getData('old_project_id', '');
            $intOldOrderId = $this->request->getData('old_order_id', '');
            $strScreen = $this->request->getData('screen', '');

            $connection = ConnectionManager::get('default');
            $connection->begin();

            if ($this->Project->save($project)) {

                $aryOrderResult = $this->saveOrder($project->id, $params['order']);
                if(isset($aryOrderResult['error'])) {
                    $aryError = $aryOrderResult['error'];
                } else {
                    $orderId = $aryOrderResult->id;
                    $this->saveLogUpdateProject($aryOrderResult, $params);
                    //$aryCalculateProductResult = $this->reCalculateProduct($params['order_detail']);
                    $arySaveOrderDetailResult = $this->saveOrderDetail($project->id, $orderId, $params['order_detail']);
                    /*
                    if(isset($aryCalculateProductResult['error'])) {
                        $aryError = $aryError + $aryCalculateProductResult['error'];
                    }
                    */
                    if(isset($arySaveOrderDetailResult['error'])) {
                        $aryError = $aryError + $arySaveOrderDetailResult['error'];
                    }

                    if(!$aryError && $aryAttached &&
                        $attachedRes = $this->saveAttached([
                            'project_id' => $project->id,
                            'order_id' => $orderId,
                            'screen' => $strScreen,
                            'old_project_id' => $intOldProjectId,
                            'old_order_id' => $intOldOrderId
                        ], $aryAttached)) {

                        if(isset($attachedRes['error'])) {
                            $aryError = $attachedRes['error'];
                        } else {
                            $aryMoveFile = $attachedRes['data'];
                        }
                    }
                }
            }

            if($project->getErrors()) {
                $aryError = $project->getErrors() + $aryError;
            }

            if($aryError) {
                $this->errorFlash($aryError);
                $connection->rollback();
            } else {
                //move file
                if(isset($aryMoveFile)) {
                    $this->moveFile($aryMoveFile, $strTempoToken);
                }

                //generate and save project code
                $this->saveProjectCode($project->id);
                //log
                $this->saveOrderNotification($orderId, $params);

                // send mail and show message
                if(isset($params['is_sendmail']) && $params['is_sendmail'] == 1
                    && isset($params['order_detail']['supplier_id']) && ($arySupplierId = $params['order_detail']['supplier_id'])
                ) {
                    //send mail
                    $arySupplierId = array_unique($arySupplierId);
                    $aryMSupplier = $this->MSupplier->find()
                        ->select(['id', 'mei_1', 'email'])
                        ->where(['deleted is null', 'id IN' => $arySupplierId])->toArray();
                    $strSubject = 'e-暮らし';

                    foreach ($aryMSupplier as $objMSupplier) {
                        if($objMSupplier->email) {
                            $this->MailService->sendMail([
                                'subject' => $strSubject,
                                'to' => $objMSupplier->email,
                                'template' => 'send_to_partner',
                                'view' => ['name' => $objMSupplier->mei_1]
                            ]);
                        }
                        if($msgSaved === '') {
                            $msgSaved = '受注データの登録と送信を完了しました';
                        }
                    }
                } else {
                    if($project->type == ProjectTable::YOTEI_TYPE) {
                        $msgSaved = '予定データを登録しました';
                    } else {
                        $msgSaved = '受注データの登録のみを完了しました';
                    }
                }

                if($msgSaved) {
                    $this->msgFlash($msgSaved);
                }

                $connection->commit();
                return $this->redirect([
                    'controller' => 'Project',
                    'action' => $project->type == ProjectTable::YOTEI_TYPE ? 'yoteiHenshuu' : 'kakuteiHenshuu',
                    Crypt::encrypAES($orderId)
                ]);
            }
        }
        else if($customer_decrypted) {
            $m_customer_id = Crypt::decryptAES($customer_decrypted);
            $m_customer = $this->MCustomer->find()->where(["id" => $m_customer_id, "deleted is null"])->first();

            if($m_customer) {
                $project->e_moushisha_mei = $m_customer->tokui_saki_mei1;
                $project->e_moushisha_juushotodoufuken = $m_customer->e_moushisha_youbinbangou . ' ' . $m_customer->e_moushisha_juusho_todoufuken;
                $project->e_moushisha_juushoshichou = $m_customer->e_moushisha_juusho_shikuchousonikou;
                $project->m_customer_id = $m_customer->id;
            }
        }

        $this->set(compact('project', 'aryAttached', 'strTempoToken', 'mstSystem', 'aryMediation'));
    }

    private function reCalculateProduct($aryOrderDetails, $orderDetails = null)
    {
        $currentAction = $this->request->getParam('action');
        $error = [];
        if($currentAction == 'kakuteiTouroku' || $currentAction == 'kakuteiHenshuu' || $currentAction == 'copy') {
            $suuryou = [];
            if($currentAction == 'kakuteiHenshuu') {
                foreach ($orderDetails as $orderDetail) {
                    $suuryou[$orderDetail->m_product_id] = isset($suuryou[$orderDetail->m_product_id]) ?
                        ($suuryou[$orderDetail->m_product_id] + $orderDetail->suuryou) : $orderDetail->suuryou;
                }
            }

            foreach ($aryOrderDetails['product_id'] as $key => $id) {
                $mProduct = $this->MProduct->get($id, [
                    'contain' => []
                ]);

                $newSuuryou = $mProduct->ekisei_zaiko_suuryou -  (int) $aryOrderDetails['suuryou'][$key];
                if(isset($suuryou[$id])) {
                    $newSuuryou += $suuryou[$id];
                }

                if($newSuuryou < 0) {
                    $error[] = $mProduct->mei.'にて在庫の数量より多く入力しています。再度ご確認ください。';
                }

                $mProduct = $this->MProduct->patchEntity($mProduct, ['ekisei_zaiko_suuryou' => $newSuuryou]);

                if(!$this->MProduct->save($mProduct)) {
                    $error[] = $mProduct->getError();
                }

            }
        }

        return !empty($error) ? ['error' => $error] : true;
    }

    /**
     * Type: action
     * Method: get|post
     */
    public function kakuteiTouroku($customer_decrypted = null)
    {
        return $this->yoteiTouroku($customer_decrypted);
    }

    /**
     * action: click to button 予定データ選択
     * Method: get|post
     */
    public function copy($orderId=null)
    {
        return $this->request->is(['patch', 'post', 'put']) ? $this->yoteiTouroku() : $this->yoteiHenshuu($orderId);
    }

    /**
     * action: click to button 新規伝票発行
     * Method: get|post
     */
    public function shinkiDenpyou($orderId=null)
    {
        return $this->yoteiHenshuu($orderId);
    }

    /**
     * action: 案件検索
     * Method: get|post
     */
    public function ankenHenshuu($orderId=null)
    {
        return $this->yoteiHenshuu($orderId);
    }

    /**
     * action: 既存データ案件検索
     * Method: get|post
     */
    public function kizonHenshuu($orderId=null)
    {
        return $this->yoteiHenshuu($orderId);
    }
    /**
     * Save order method
     *
     * @param $order
     * @param $params
     * @return \App\Model\Entity\LogUpdateProject|bool
     */
    private function saveLogUpdateProject($order, $params)
    {
        //order
        $logUpdateProject = $this->LogUpdateProject->newEntity();
        $logUpdateProject = $this->LogUpdateProject->patchEntity($logUpdateProject, [
            'order_id' => $order->id,
            'm_user_id' => self::$aryLoginUser['id'],
            'bangou' => $order->juchuu_bangou,
            'status' => isset($params['log_update_project']['title']) ? $params['log_update_project']['title'] : null
        ]);

        return $this->LogUpdateProject->save($logUpdateProject);
    }

    /**
     * Save order method
     *
     * @param $projectId
     * @param $params
     * @return array
     */
    private function saveOrder($projectId, $params)
    {
        //order
        $id = $params['id'];
        if($id == 0) {
            $params['project_id'] = $projectId;
            list($params['bangou'], $params['juchuu_bangou']) = $this->generateOrderCode($projectId);
        }
        if($id > 0) {
            $order = $this->Orders->find()->where(['id' => $id, 'deleted is' => null])->first();
        } else {
            $order = $this->Orders->newEntity();
            $order->user_created = self::$aryLoginUser['id'];
        }
        $order->last_user_modified = self::$aryLoginUser['id'];

        $order = $this->Orders->patchEntity($order, $params);

        if ($res = $this->Orders->save($order)) {
            $aryResult = $res;
        } else {
            $aryResult = ['error' => $order->getErrors()];
        }

        return $aryResult;
    }

    /**
     * Create new generate code  case insert project
     *
     * @param $projectId
     * @return object
     */
    private function saveProjectCode($projectId) {
        $strProjectCode = Utility::genProjectCode($projectId);
        return $this->Project->updateAll(['bangou' => $strProjectCode], ['id' => $projectId]);
    }

    /**
     * only update keiju
     *
     * @param $orderDetail
     * @return object
     */
    private function updateKeijou($orderDetail) {
        if($orderDetail['list_id_is_checked'] != '') {
            $this->updateOrderDetail([
                'id' => $orderDetail['list_id_is_checked'],
                'keijou' => 1
            ]);
        }

        if($orderDetail['list_id_is_uncheck'] != '') {
            $this->updateOrderDetail([
                'id' => $orderDetail['list_id_is_uncheck'],
                'keijou' => 0
            ]);
        }
    }

    /**
     * Create new generate code  case insert project
     *
     * @param $orderId
     * @param $params
     *
     * @return object
     */
    private function saveOrderNotification($orderId, $params) {
        if(isset($params['order_notification'])) {
            $params['order_notification']['order_id'] = $orderId;
            $params['order_notification']['m_user_id'] = self::$aryLoginUser['id'];

            if($id = self::$aryLoginUser['m_supplier_id']) {
                $mSupplier = $this->MSupplier->get($id, [
                    'contain' => []
                ]);
                $params['order_notification']['m_system_tantousha_id'] = $mSupplier && $mSupplier->m_system_tantousha_id
                    ? $mSupplier->m_system_tantousha_id : null;
            }

            if($orderId) {
                $mOrder = $this->Orders->get($orderId, [
                    'contain' => []
                ]);

                $params['order_notification']['title'] = date('Y/m/d',strtotime($mOrder->modified)).'　'.
                    $mOrder->juchuu_bangou.'　'.self::$aryLoginUser['name'].'　'.$params['order_notification']['title'] ;
            }

            $orderNotification = $this->OrderNotification->newEntity();
            $orderNotification = $this->OrderNotification->patchEntity($orderNotification, $params['order_notification']);

            return $this->OrderNotification->save($orderNotification);
        }

        return true;
    }

    /**
     * Create new generate code  case insert order
     *
     * @param $projectId
     * @return array
     */
    private function generateOrderCode($projectId) {
        $intOrdersByProject = $this->Orders->find()
            ->select(['id'])
            ->where(['project_id' => $projectId])
            ->count();
        $intOrdersByProject++;

        $strProjectCode = Utility::genProjectCode($projectId);
        $strOrderCode = Utility::genOrderCode($intOrdersByProject);
        $strMitsumoriNo = $strProjectCode . '-' . $strOrderCode;

        return [$strOrderCode, $strMitsumoriNo];
    }

    /**
     * Save order detail method
     */
    public function updateOrderDetail($params)
    {
        $aryResult = [];
        $aryOrderDetailId = explode(",", $params['id']);
        unset($params['id']);
        if(isset($params['okyakusama_kakunin']) && ($aryOkyakusamaKakunin = $params['okyakusama_kakunin'])) {
            $params['okyakusama_kakunin'] = implode(',', $aryOkyakusamaKakunin);
        }
        $fields = [];
        foreach ($params as $k => $v) {
            if(!is_array($v)) {
                if(in_array($k,['nouki_kaishibi','nouki_shuuryoubi']))
                    $fields[$k] = $v ? $v : null;
                else
                    $fields[$k] = $v;
            }
        }
        if(!empty($aryOrderDetailId)) {
            try {
                $this->OrderDetail->updateAll($fields,['id in' => $aryOrderDetailId]);
            } catch (\Exception $e) {
                $aryResult = ['error' => $e->getMessage()];
            }
        } else {
            $aryResult = ['error' => Message::ERROR_OCCURRED];
        }
        return $aryResult;
    }

    /**
     * Save order detail method
     */
    public function saveOrderDetail($projectId, $orderid, $params)
    {
        $aryResult = [];
        if(!empty($params['product_id'])) {
            //save multi record
            $fields = [
                'project_id',
                'order_id',
                'm_product_id',
                'm_supplier_id',
                'tani',
                'koudo',
                'mei',
                'suuryou',
                'hatchuu_tanka',
                'hatchuu_kingaku',
                'juchuu_tanka',
                'juchuu_kingaku',
                'm_system_houmon_jikan_id',
                'houmon_jikan_kaishi',
                'houmon_jikan_shuuryou',
                'nouki_kaishibi',
                'nouki_shuuryoubi',
                'shori_joukyou',
                'shori_jiyuu',
                'seikan',
                'm_system_joutaikubun_id',
                'hatchuu_bangou'
            ];

            $houmonJikanKaishi = isset($params['houmon_jikan_kaishi']) ? $params['houmon_jikan_kaishi'] : '';
            $noukibiShuuryoubi = isset($params['nouki_shuuryoubi']) ? $params['nouki_shuuryoubi'] : '';
            $noukibiKaishibi = isset($params['nouki_kaishibi']) ? $params['nouki_kaishibi'] : '';
            $mSystemHoumonJikanId = isset($params['m_system_houmon_jikan_id']) ? $params['m_system_houmon_jikan_id'] : '';
            $arySupplier = isset($params['supplier_id']) ? $params['supplier_id'] : '';
            $data = [];
            $aryCheckSupplier = [];
            $hatchuuBangou = 0;
            foreach ($params['product_id'] as $key => $productId) {
                $supplierId = $arySupplier[$key];
                $tani = array_search($params['tani'][$key], MProductTable::TANI_VALUE) ?: null;
                $mSystemHoumonJikanIdValue = is_array($mSystemHoumonJikanId) ? $mSystemHoumonJikanId[$supplierId] : $mSystemHoumonJikanId;
                $houmonJikanKaishiValue = is_array($houmonJikanKaishi) ? $houmonJikanKaishi[$supplierId] : $houmonJikanKaishi;
                $noukibiShuuryoubiValue = is_array($noukibiShuuryoubi) ? $noukibiShuuryoubi[$supplierId] : $noukibiShuuryoubi;
                $noukibiKaishibiValue = is_array($noukibiKaishibi) ? $noukibiKaishibi[$supplierId] : $noukibiKaishibi;

                if(in_array($supplierId, $aryCheckSupplier)) {
                    $hatchuuBangou++;
                } else {
                    $hatchuuBangou = 1;
                    $aryCheckSupplier[] = $supplierId;
                }

                $values = [
                    $projectId,
                    $orderid,
                    $productId,
                    $supplierId,
                    $tani,
                    $params['koudo'][$key],
                    $params['mei'][$key],
                    $params['suuryou'][$key],
                    $params['hatchuu_tanka'][$key],
                    $params['hatchuu_kingaku'][$key],
                    $params['juchuu_tanka'][$key],
                    $params['juchuu_kingaku'][$key],
                    $mSystemHoumonJikanIdValue,
                    $houmonJikanKaishiValue,
                    isset($params['houmon_jikan_shuuryou']) ? $params['houmon_jikan_shuuryou'] : null,
                    $noukibiKaishibiValue,
                    $noukibiShuuryoubiValue,
                    isset($params['shori_joukyou']) ? $params['shori_joukyou'] : null,
                    isset($params['shori_jiyuu']) ? $params['shori_jiyuu'] : null,
                    isset($params['seikan']) ? $params['seikan'] : null,
                    isset($params['m_system_joutaikubun_id']) ? $params['m_system_joutaikubun_id'] : null,
                    $hatchuuBangou
                ];
                $data[] = array_combine($fields, $values);
            }

            $entities = $this->OrderDetail->newEntities($data);

            try {
                if ($result = $this->OrderDetail->saveMany($entities)) {

                } else {
                    $aryResult = ['error' => $entities->getErrors()];
                }
            } catch (\Exception $e) {
                $aryResult = ['error' => $e->getMessage()];
            }
        }

        return $aryResult;
    }

    /**
     * @param $aryData['project_id', 'order_id', '!supplier_id', '!screen', '!old_project_id', '!old_order_id']
     * @param array $aryAttached
     * @return array
     */
    private function saveAttached($aryData, $aryAttached = [])
    {
        $intKey = $intSupplierId = $intOldProjectId = $intOldOrderId = 0;
        $strScreen = '';
        $aryResult = $aryAttachedData = $aryMoveFile =[];
        $aryFirstAttached = reset($aryAttached);

        //valid
        if(!isset($aryFirstAttached['id'])
            || !isset($aryFirstAttached['name'])
            || !isset($aryFirstAttached['view_name'])) {
            return ['error' => 'attached params invalid'];
        }
        if(self::$aryLoginUser['type'] == MUserTable::TYPE_PARTNER && self::$aryLoginUser['m_supplier_id']) {
            $intSupplierId = self::$aryLoginUser['m_supplier_id'];
        }
        if(isset($aryData['screen'])) {
            $strScreen = $aryData['screen'];
        }
        if(isset($aryData['old_project_id'])) {
            $intOldProjectId = $aryData['old_project_id'];
        }
        if(isset($aryData['old_order_id'])) {
            $intOldOrderId = $aryData['old_order_id'];
        }

        foreach ($aryAttached as $itemAttached) {
            $id = $itemAttached['id'];
            $name = $itemAttached['name'];
            $viewName = $itemAttached['view_name'];

            if($strScreen !== 'copy') {
                if($id) continue;
            }

            //new
            $aryAttachedData[$intKey]['project_id'] = $aryData['project_id'];
            $aryAttachedData[$intKey]['order_id'] = $aryData['order_id'];
            if($intSupplierId) {
                $aryAttachedData[$intKey]['supplier_id'] = $intSupplierId;
            }
            $aryAttachedData[$intKey]['name'] = $name;
            $aryAttachedData[$intKey]['view_name'] = $viewName;

            if($strScreen === 'copy' && $id) {
                $aryMoveFile['copy'][] = [
                    'project_id' => $aryData['project_id'],
                    'order_id' => $aryData['order_id'],
                    'name' => $name,
                    'copy_project_id' => $intOldProjectId,
                    'copy_order_id' => $intOldOrderId
                ];
            } else {
                $aryMoveFile['new'][] = [
                    'project_id' => $aryData['project_id'],
                    'order_id' => $aryData['order_id'],
                    'name' => $name
                ];
            }

            $intKey++;
        }

        if($aryAttachedData) {
            $entityOrderAttachedFile = $this->OrderAttachedFile->newEntities($aryAttachedData);
            try {
                if ($this->OrderAttachedFile->saveMany($entityOrderAttachedFile)) {
                    $aryResult = ['data' => $aryMoveFile];
                } else {
                    $aryResult = ['error' => $entityOrderAttachedFile->getErrors()];
                }
            } catch (\Exception $e) {
                $aryResult = ['error' => $e->getMessage()];
            }
        }

        return $aryResult;
    }

    /**
     * @param $aryData['order_id']
     * @param array $aryDeleted
     * @return array
     */
    private function deleteAttached($aryData, $aryDeleted = []) {
        $aryResult = $aryDeletedData = $aryDeleteFile =[];
        $aryOrderAttachedFile = $this->OrderAttachedFile->find()
            ->where([
                'order_id' => $aryData['order_id'],
                'id IN' => $aryDeleted
            ]);

        foreach ($aryOrderAttachedFile as $itemOrderAttachedFile) {
            $aryDeletedData[] = $itemOrderAttachedFile->id;
            $aryDeleteFile[] = [
                'project_id' => $itemOrderAttachedFile->project_id,
                'order_id' => $itemOrderAttachedFile->order_id,
                'name' => $itemOrderAttachedFile->name,
            ];
        }

        if($aryDeletedData) {
            if($this->OrderAttachedFile->deleteAll(['id IN' => $aryDeletedData])) {
                $aryResult['data'] = $aryDeleteFile;
            } else {
                $aryResult['error'] = 'Not delete';
            }
        }

        return $aryResult;
    }

    /**
     * Type: action
     * Method: get|post
     * @param $conditions
     * @return array
     */
    public function getOrderDetails($conditions)
    {
        return $this->OrderDetail->find('all')
            ->select([
                'MProduct.id','MProduct.mei','MProduct.koudo',
                'MProduct.naiyou','MProduct.tani','MProduct.ekisei_zaiko_suuryou','MProduct.m_system_shouhin_kategori_id',
                'MSupplier.id', 'MSupplier.mei_1', 'MSupplier.denwa', 'MSupplier.fax', 'MSupplier.m_system_tantousha_id',
                'shori_jiyuu','shori_joukyou','keijou','mei','koudo',
                'okyakusama_kakunin','henkou_taiou_umu','okyakusama_no_youbou','henkou_jiyuu','tokukijikou',
                'id','hatchuu_tanka','hatchuu_kingaku','juchuu_tanka','juchuu_kingaku','suuryou','tani','m_product_id',
                'm_system_houmon_jikan_id','houmon_jikan_kaishi','houmon_jikan_shuuryou','m_supplier_id','keijou',
                'sagyou_kikan', 'nouki_kaishibi', 'nouki_shuuryoubi', 'kakunin_joutai','m_system_joutaikubun_id', 'status'
            ])
            ->where($conditions)
            ->innerJoinWith('MProduct',function($query){
                return $query;
            })
            ->leftJoinWith('MSupplier',function($query){
                return $query;
            })

            ->orderDesc('OrderDetail.m_supplier_id')
            ->orderAsc('OrderDetail.id')
            ->toArray();
    }

    /**
     * Type: action
     * Method: get|post
     * @param $conditions
     * @return array $aryAttached
     */
    public function getOrderAttached($conditions)
    {
        return $this->OrderAttachedFile->find()
            ->where($conditions)
            ->orderDesc('created')
            ->toArray();
    }

    public function downloadFile($orderAttachmentId)
    {
        $orderAttachment = $this->OrderAttachedFile->get($orderAttachmentId, ['contain' => []]);
        $path = Constant::PROJECT_PATH.$orderAttachment->project_id.DS.$orderAttachment->order_id.DS.$orderAttachment->name;
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$orderAttachment->view_name.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        flush(); // Flush system output buffer
        readfile($path);
        exit;
    }

    /**
     * Type: action
     * Method: get|post
     * @return array
     */
    public function generateConditionForTouroku()
    {
        return [
            'MSystem.type_name IN' => [
                MSystemTable::SYSTEM_SHIHARAI_HOUHOU,
                MSystemTable::SYSTEM_BUMON_ID,
                MSystemTable::SYSTEM_KAMOKU_ID,
                MSystemTable::SYSTEM_TANTOUSHA,
                MSystemTable::SYSTEM_KANJOU_KAMOKU,
                MSystemTable::SYSTEM_HOUMON_JIKAN,
                MSystemTable::SYSTEM_ANKEN_CD,
                MSystemTable::SYSTEM_JOUTAI_KUBUN,
                MSystemTable::SYSTEM_KATEGORI_ID,
            ]
        ];
    }

    /**
     * Type: action
     * Method: get|post
     * @param null $orderId
     * @return \Cake\Http\Response|null
     */
    public function yoteiHenshuu($orderId = null)
    {
        $aryError = [];
        $msgSaved = '';
        $strTempoToken = Utility::genToken();
        $id = Crypt::decryptAES($orderId);

        $order = $this->Orders->get($id, ['contain' => []]);
        $project = $this->Project->find()->where(['id' => $order->project_id, 'deleted is' => null])->first();

        $orderDetails = $order ? $this->getOrderDetails(['OrderDetail.order_id' => $order->id]) : null;
        $mstSystem = $order ? $this->getMstSystem($this->generateConditionForTouroku()) : [];
        $aryMediation = $this->MstService->getGensen();
        if($project->type == ProjectTable::KAKUTEI_TYPE) {
            $aryOrderComment = $this->OrderComment->find('list', ['keyField' => 'keyField', 'valueField' => 'valueField'])
                ->select(['keyField' => 'm_supplier_id', 'valueField' => 'last_comment_date'])
                ->where([
                    'order_id' => $order->id,
                    'project_id' => $order->project_id,
                    'deleted is' => null
                ])->toArray();
        }

        $aryAttached = $order ? $this->getOrderAttached([
            'order_id' => $order->id,
            'supplier_id is null'
        ]) : [];

        $arySanshou = $order ? $this->getOrderAttached([
            'order_id' => $order->id,
            'supplier_id is not null'
        ]) : [];

        if ($this->request->is(['patch', 'post', 'put'])) {
            $params = $this->request->getData();
            $project = $this->Project->patchEntity($project, $params['project']);
            $strTempoToken = $this->request->getData('tempo_token');
            $aryAttached = $this->request->getData('attached', []);
            $aryAttachedDeleteId = $this->request->getData('attached_delete_id', []);
            $arySupplierDeleteId = $this->request->getData('supplier_delete_id', []);
            $connection = ConnectionManager::get('default');
            $connection->begin();

            unset($params['order']['created']);
            $this->getOrderDetailJoutaiKubun($params);
            if ($this->Project->save($project)) {
                $aryOrderResult = $this->saveOrder($project->id, $params['order']);
                // save to table log_update_project
                $this->saveLogUpdateProject($aryOrderResult, $params);
                if(isset($aryOrderResult['error'])) {
                    $aryError = $aryOrderResult['error'];
                } else {
                    $orderId = $aryOrderResult->id;
                    if($this->request->getParam('action') == 'kanryouKeijouShori') {
                        $this->updateKeijou($params['order_detail']);
                    } else {
                        //$aryCalculateProductResult = $this->reCalculateProduct($params['order_detail'], $orderDetails);
                        //delete OrderDetail before
                        $this->OrderDetail->deleteAll(['order_id' => $orderId]);
                        //save new data
                        $arySaveOrderDetailResult = $this->saveOrderDetail($project->id, $orderId, $params['order_detail']);
                    }

                    if($arySupplierDeleteId) {
                        $this->OrderComment->updateAll(['deleted' => Utility::dbDate()], [
                            'project_id' => $project->id,
                            'order_id' => $orderId,
                            'm_supplier_id IN' => $arySupplierDeleteId
                        ]);
                    }
                    /*
                    if(isset($aryCalculateProductResult['error'])) {
                        $aryError = $aryCalculateProductResult['error'];
                    }
                    */
                    if(isset($arySaveOrderDetailResult['error'])) {
                        $aryError = $aryError + $arySaveOrderDetailResult['error'];
                    }

                    //file
                    if(!$aryError && $aryAttached &&
                        $attachedRes = $this->saveAttached(['project_id' => $project->id, 'order_id' => $orderId], $aryAttached)) {
                        if(isset($attachedRes['error'])) {
                            $aryError = $attachedRes['error'];
                        } else {
                            $aryMoveFile = $attachedRes['data'];
                        }
                    }

                    if($aryAttachedDeleteId &&
                        $deletedRes = $this->deleteAttached(['order_id' => $orderId], $aryAttachedDeleteId)) {
                        if(isset($deletedRes['error'])) {
                            $aryError = $aryError + $deletedRes['error'];
                        } else {
                            $aryDeletedFile = $deletedRes['data'];
                        }
                    }
                }
            }

            if($project->getErrors()) {
                $aryError = $project->getErrors() + $aryError;
            }

            if($aryError) {
                $this->errorFlash($aryError);
                $connection->rollback();
            } else {
                //move file
                if(isset($aryMoveFile)) {
                    $this->moveFile($aryMoveFile, $strTempoToken);
                }

                //delete file
                if(isset($aryDeletedFile)) {
                    $this->deleteFileHaveId($aryDeletedFile);
                }
                //log
                $this->saveOrderNotification($orderId, $params);

                // send mail and show message
                if(isset($params['is_sendmail']) && $params['is_sendmail'] == 1
                    && isset($params['order_detail']['supplier_id']) && ($arySupplierId = $params['order_detail']['supplier_id'])
                ) {
                    //send mail
                    $arySupplierId = array_unique($arySupplierId);
                    $aryMSupplier = $this->MSupplier->find()
                        ->select(['id', 'mei_1', 'email'])
                        ->where(['deleted is null', 'id IN' => $arySupplierId])->toArray();
                    $strSubject = 'e-暮らし';

                    foreach ($aryMSupplier as $objMSupplier) {
                        if($objMSupplier->email) {
                            $this->MailService->sendMail([
                                'subject' => $strSubject,
                                'to' => $objMSupplier->email,
                                'template' => 'send_to_partner',
                                'view' => ['name' => $objMSupplier->mei_1]
                            ]);
                        }
                        if($msgSaved === '') {
                            $msgSaved = '更新データの登録と送信を完了しました';
                        }
                    }
                } else {
                    if($project->type == ProjectTable::YOTEI_TYPE) {
                        $msgSaved = '予定データを更新しました';
                    } else {
                        $msgSaved = '更新データの登録のみを完了しました';
                    }
                }

                if($msgSaved) {
                    $this->msgFlash($msgSaved);
                }

                $connection->commit();
                return $this->redirect([
                    'controller' => 'Project',
                    'action' => $this->request->getParam('action') === 'kanryouKeijouShori'
                        ? 'kanryouKeijouShori'
                        : ($project->type == ProjectTable::YOTEI_TYPE ? 'yoteiHenshuu' : 'kakuteiHenshuu'),
                    Crypt::encrypAES($orderId)
                ]);
            }

        }

        if($project->type == ProjectTable::KAKUTEI_TYPE) {
            $this->set('aryOrderComment', $aryOrderComment);
        }

        $this->set(compact('project', 'mstSystem', 'aryMediation', 'aryAttached', 'arySanshou', 'strTempoToken', 'order', 'orderDetails'));
    }

    /**
     * Type: action
     * Method: get|post
     */
    public function kakuteiHenshuu($id)
    {
        return $this->yoteiHenshuu($id);
    }

    /**
     * Type: action
     * Method: get|post
     */
    public function kanryouKeijouShori($id)
    {
        return $this->yoteiHenshuu($id);
    }

    /**
     * @param $object
     * @return array
     */
    public function checkResult($aryResult) {
        if(isset($aryResult['error'])) {
            $this->errorFlash($aryResult['error']);
            return false;
        }

        return true;
    }



    /**
     * Type: action
     * Method: get|post
     */
    public function kakuninShori($orderId)
    {
        $strTempoToken = Utility::genToken();
        $id = Crypt::decryptAES($orderId);

        $this->checkDataAccess($order = $this->Orders->find()->where([
            'id' => $id,
            'status' => OrdersTable::STATUS_REGISTER,
            'deleted is' => null])->first());

        $this->checkDataAccess($project = $order ? $this->Project->find()->where([
            'id' => $order->project_id,
            'type' => ProjectTable::KAKUTEI_TYPE,
            'deleted is' => null])->first() : null);

        $this->checkDataAccess($orderDetails = $order ? $this->getOrderDetails([
            'OrderDetail.order_id' => $order->id,
            'OrderDetail.m_supplier_id' => self::$aryLoginUser['m_supplier_id'],
            'OrderDetail.deleted is' => null
        ]) : null);

        $aryAttached = $order ? $this->getOrderAttached([
            'order_id' => $order->id,
            'supplier_id' => self::$aryLoginUser['m_supplier_id']
        ]) : [];

        $arySanshou = $order ? $this->getOrderAttached([
            'order_id' => $order->id,
            'supplier_id is' => null
        ]) : [];

        $objCustomer = $this->MCustomer->find()->where(['id' => $project->m_customer_id, 'deleted is' => null])->first();

        $aryOrderComment = $this->OrderComment->find('list', ['keyField' => 'keyField', 'valueField' => 'valueField'])
            ->select(['keyField' => 'm_supplier_id', 'valueField' => 'last_comment_date'])
            ->where([
                'order_id' => $order->id,
                'project_id' => $project->id,
                'm_supplier_id' => self::$aryLoginUser['m_supplier_id'],
                'deleted is' => null
            ])->toArray();

        $mstSystem = $order ? $this->getMstSystem($this->generateConditionForTouroku()) : [];

        if($orderDetails)
            $orderDetails[0]->m_supplier_name = $this->getSupplierName(self::$aryLoginUser['m_supplier_id']);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $params = $this->request->getData();
            $project = $this->Project->patchEntity($project, $params['project']);

            unset($params['order']['created']);
            $this->getOrderDetailJoutaiKubun($params);
            $connection = ConnectionManager::get('default');
            $connection->begin();
            if ($this->Project->save($project)) {
                    $orderId = $params['order']['id'];
                    if($this->checkResult($this->updateOrderDetail($params['order_detail']))) {
                        // case 戻し条件
                        $this->updateOrder($orderId, $params);
                        // save to table log_update_project
                        $this->saveLogUpdateProject($order, $params);
                        $aryAttached = $this->request->getData('attached', []);
                        $check = true;
                        if($aryAttached) {
                            if($check = $this->checkResult($attachedRes = $this->saveAttached(['project_id' => $project->id, 'order_id' => $orderId], $aryAttached))) {
                                $strTempoToken = $this->request->getData('tempo_token');
                                //move file
                                if(isset($attachedRes['data'])) {
                                    $this->moveFile($attachedRes['data'], $strTempoToken);
                                }
                            }
                        }
                        if($check) {
                            $aryAttachedDeleteId = $this->request->getData('attached_delete_id', []);
                            if($aryAttachedDeleteId &&
                                $check = $this->checkResult($deletedRes = $this->deleteAttached(['order_id' => $orderId], $aryAttachedDeleteId))) {
                                $aryDeletedFile = $deletedRes['data'];
                                //delete file
                                if(isset($aryDeletedFile)) {
                                    $this->deleteFileHaveId($aryDeletedFile);
                                }
                            }
                        }

                        if($check) {
                            $this->saveOrderNotification($orderId, $params);
                        }

                        if($check) {
                            $this->successFlash(Message::SAVED);
                            $connection->commit();

                            return $this->redirect([
                                'controller' => 'Project',
                                'action' => $this->request->getParam('action') == 'kakuninShori' ?
                                    'kakuninShoriIchiran' : 'ankenKanryouTouroku'
                            ]);
                        }
                    }
                    $connection->rollback();
            } else {
                $this->errorFlash($project->getErrors());
                $connection->rollback();
            }
        }

        $this->set(compact('project', 'mstSystem', 'aryAttached', 'aryOrderComment', 'objCustomer', 'arySanshou', 'strTempoToken', 'order', 'orderDetails'));
    }

    /**
     *  partner display
     *
     * Type: updateOrder
     */
    public function updateOrder($orderId, $params)
    {
        //check and update Order.m_system_joutaikubun_id
        $orderDetails = $this->OrderDetail->find()
            ->select([
                'm_system_joutaikubun_id',
                'nouki_kaishibi',
                'nouki_shuuryoubi'
            ])
            ->where([
                'order_id' => $orderId,
                'deleted is' => null,
                'm_supplier_id is not' => null,
                'm_supplier_id <>' => OrderDetailTable::EKURASHI_KAISHA_ID
            ]);
        if($orderDetails) {
            $m_system_joutaikubun_id = [];
            $nouki_kaishibi = [];
            $nouki_shuuryoubi = [];
            foreach ($orderDetails as $orderDetail) {
                $m_system_joutaikubun_id[] = array_search($orderDetail->m_system_joutaikubun_id,OrderDetailTable::JOUTAI_KUBUN_ASC);
                $nouki_kaishibi[] = $orderDetail->nouki_kaishibi;
                $nouki_shuuryoubi[] = $orderDetail->nouki_shuuryoubi;
            }

            if(!empty($m_system_joutaikubun_id)) {
                $fields['m_system_joutaikubun_id'] = OrderDetailTable::JOUTAI_KUBUN_ASC[min($m_system_joutaikubun_id)];
                $fields['nouki_kaishibi'] = min($nouki_kaishibi);
                $fields['nouki_shuuryoubi'] = max($nouki_shuuryoubi);
            }
        }
        //case OrderDetail.shori_joukyou = 戻し条件
        if(isset($params['order_detail']['shori_joukyou']) && $params['order_detail']['shori_joukyou'] == OrderDetailTable::MODOSHI_JOUKEN) {
            $fields['shori_joukyou'] = OrdersTable::MODOSHI_JOUKEN;
        }

        return $this->Orders->updateAll($fields,['id' => $orderId]);
    }

    /**
     * Type: action
     * Method: get(ajax)
     */
    public function ankenKanryouShori($orderId)
    {
        return $this->kakuninShori($orderId);
    }
    /**
     * Type: action
     * Method: post|ajax
     *
     * @param null $token
     */
    public function addFile($token = null) {
        $this->autoRender = false;
        $aryResult['status'] = false;

        //valid param
        if(!$this->request->is('ajax') || !$this->request->is('post') || !$token) {
            $aryResult['error'] = Message::INVALID_REQUEST ;
            $this->jsonResponse($aryResult);
        }

        if(!$this->getRequest()->getUploadedFile('file_data')) {
            $aryResult['error'] = Message::INVALID_REQUEST ;
            $this->jsonResponse($aryResult);
        }

        $objFile = $this->getRequest()->getData('file_data');

        if($objFile['error'] === 0) {
            //update
            if(is_numeric($token)) {

            }
            //create
            else {
                $oldFileName = $objFile['name'];
                $ext = strtolower(pathinfo($oldFileName, PATHINFO_EXTENSION));
                $tmpPath = Constant::PROJECT_TEMPS."$token/";
                if($error = Utility::createFolder($tmpPath)) {
                    $aryResult['error'] = $error;
                } else {
                    $newFileName = Utility::fileName($ext);
                    $newPath = $tmpPath.$newFileName;
                    if(is_dir($tmpPath)) {
                        if(move_uploaded_file($objFile['tmp_name'], $newPath)) {
                            $aryResult['status'] = true;
                            $aryResult['data']['token'] = $token;
                            $aryResult['data']['view_name'] = $oldFileName;
                            $aryResult['data']['name'] = $newFileName;
                        } else {
                            $aryResult['error'] = Message::ERROR_OCCURRED;
                        }
                    } else {
                        $aryResult['error'] = Message::PERMISSION_DENIED;
                    }
                }
            }
        } else {
            $aryResult['error'] = Message::FILE_CORRUPTED;
        }

        $this->jsonResponse($aryResult);
    }

    /**
     * Type: action
     * Method: post|ajax
     *
     * @param null $token
     */
    public function deleteFile($token = null) {
        $this->autoRender = false;
        $aryResult['status'] = false;

        //valid param
        if(!$this->request->is('ajax') || !$this->request->is('post') || !$token) {
            $aryResult['error'] = Message::INVALID_REQUEST ;
            $this->jsonResponse($aryResult);
        }

        if(!$this->getRequest()->getData('name')) {
            $aryResult['error'] = Message::INVALID_PARAM ;
            $this->jsonResponse($aryResult);
        }

        $fileName = $this->getRequest()->getData('name');
        $tmpPath = Constant::PROJECT_TEMPS."$token/";
        $newPath = $tmpPath.$fileName;

        $aryResult['status'] = true;
        if(is_file($newPath)) {
            unlink($newPath);
            $aryResult['data']['name'] = $fileName;
        } else {
            $aryResult['error'] = 'file not found';
        }
        if(is_dir($tmpPath)) {
            $lsDir = glob( $tmpPath . '*', GLOB_MARK);
            //clear folder
            if(!$lsDir) {
                rmdir($tmpPath);
            }
        } else {
            $aryResult['error'] = 'folder not found';
        }

        $this->jsonResponse($aryResult);
    }

    private function moveFile($attachedRes, $strTempoToken) {
        if(isset($attachedRes['new']) && ($aryAttachedNew = $attachedRes['new'])) {
            $tmpPath = Constant::PROJECT_TEMPS."$strTempoToken/";
            $projectPath = Constant::PROJECT_PATH."{$aryAttachedNew[0]['project_id']}/{$aryAttachedNew[0]['order_id']}/";
            // create forder
            Utility::createFolder($projectPath);

            foreach ($aryAttachedNew as $attachedItemNew) {
                if(is_dir($tmpPath)) {
                    $strOldPath = $tmpPath.$attachedItemNew['name'];
                    $strNewPath = $projectPath.$attachedItemNew['name'];
                    if(!copy($strOldPath, $strNewPath)) {
                        return 'move file error';
                    }
                } else {
                    return 'dir token not found';
                }
            }
            Utility::deleteFiles($tmpPath);
        }

        // process move from old order
        if(isset($attachedRes['copy']) && ($aryAttachedCopy = $attachedRes['copy'])) {
            $oldProjectPath = Constant::PROJECT_PATH."{$aryAttachedCopy[0]['copy_project_id']}/{$aryAttachedCopy[0]['copy_order_id']}/";
            $projectPath = Constant::PROJECT_PATH."{$aryAttachedCopy[0]['project_id']}/{$aryAttachedCopy[0]['order_id']}/";
            // create forder
            Utility::createFolder($projectPath);

            foreach ($aryAttachedCopy as $attachedItemCopy) {
                if(is_dir($oldProjectPath)) {
                    $strOldPath = $oldProjectPath.$attachedItemCopy['name'];
                    $strNewPath = $projectPath.$attachedItemCopy['name'];
                    if(!copy($strOldPath, $strNewPath)) {
                        return 'move file error';
                    }
                } else {
                    return 'dir token not found';
                }
            }
        }
    }

    public function popup()
    {
        if ($this->request->is('ajax')) {
            $type = $this->request->getData('type');
            $projectType = $this->request->getData('project_type');

            if($type == 1) {
                $this->set('projectType', $projectType);
                echo $this->render('popup'); die;
            } else {
                $this->autoRender = false;

                $this->paginate = $this->getPaginateConfig(); //limit && page
                $this->paginate['order'] = $this->getQueryOrder();//order
                $strTableProjectType = $this->validAryKey($this->getQuerySearch(), 'project_type');
                $mstSystem = $this->getMstSystem(['MSystem.type_name IN' => [MSystemTable::SYSTEM_BUMON_ID]]);
                $aryBumon = $mstSystem[MSystemTable::SYSTEM_BUMON_ID];

                $query = $this->Orders->find('all')
                    ->contain(['Project'])
                    ->select([
                        'Project.id','Orders.id','Orders.juchuu_bangou','Project.e_moushisha_mei','Project.m_system_bumon_id',
                        'Project.e_moushisha_yuubenbangou','Project.e_moushisha_juushotodoufuken',
                        'Project.e_moushisha_juushoshichou','Project.created'
                    ])
                    ->where([
                        'Project.deleted is' => null,
                        'Project.type' => $strTableProjectType
                    ]);

                $aryOrders = $this->paginate($query);
                $aryResult = [];
                foreach ($aryOrders as $projectKey => $order) {
                    $project = $order->project;
                    $aryResult[$projectKey][] = $this->tableRadioField($order, true);
                    $aryResult[$projectKey][] = $order->juchuu_bangou;
                    $aryResult[$projectKey][] = $project->e_moushisha_mei;
                    $aryResult[$projectKey][] = isset($aryBumon[$project->m_system_bumon_id]) ? $aryBumon[$project->m_system_bumon_id] : '';
                    $aryResult[$projectKey][] = $project->e_moushisha_yuubenbangou;
                    $aryResult[$projectKey][] = $project->e_moushisha_juushotodoufuken;
                    $aryResult[$projectKey][] = $project->e_moushisha_juushoshichou;
                    $aryResult[$projectKey][] = $project->created;
                }

                $this->datatableResponse($query, $aryResult);
            }
        }
    }

    /**
     * @param $aryDeletedFile
     */
    private function deleteFileHaveId($aryDeletedFile) {
        $projectPath = '';
        $orderPath = '';
        foreach ($aryDeletedFile as $itemDeletedFile) {
            if(!$projectPath)
                $projectPath = Constant::PROJECT_PATH."{$itemDeletedFile['project_id']}/";

            if(!$orderPath)
                $orderPath = "$projectPath{$itemDeletedFile['order_id']}/";

            $deletePath = "$orderPath{$itemDeletedFile['name']}";
            if (is_file($deletePath))
                unlink($deletePath);
        }

        if(is_dir($orderPath)) {
            $lsDir = glob( $orderPath . '*', GLOB_MARK);
            //clear folder
            if(!$lsDir) {
                rmdir($orderPath);
            }
        }

        if(is_dir($projectPath)) {
            $lsDir = glob( $projectPath . '*', GLOB_MARK);
            //clear folder
            if(!$lsDir) {
                rmdir($projectPath);
            }
        }
    }

    private function ankenKensakuCondition()
    {
        $this->paginate = $this->getPaginateConfig();
        $this->paginate['order'] = $this->getQueryOrder();//order
        $this->paginate['contain'] = ['Project'];
        $this->paginate['sortWhitelist'] = [
            'Orders.juchuu_bangou', 'Orders.modified',
            'Project.e_moushisha_mei', 'Project.m_system_tantousha_id', 'Project.m_system_bumon_id',
            'Project.e_moushisha_yuubenbangou', 'Project.e_moushisha_juushotodoufuken', 'Project.e_moushisha_juushoshichou'
        ];

        //get all param search
        $pArySearch = $this->getQuerySearch();

        //search
        if ($pArySearch) {
            //like search condition
            foreach (['bangou', 'e_moushisha_mei'] as $field) {
                if ($strField = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']["Project.$field LIKE"] = "%$strField%";
                }
            }
            //= search condition
            foreach (['m_system_tantousha_id', 'm_system_bumon_id', 'type', 'm_system_joutaikubun_id'] as $field) {
                if ($value = $this->validAryKey($pArySearch, $field)) {
                    $this->paginate['conditions']["Project.$field"] = $value;
                }
            }

            if($strValue = $this->validAryKey($pArySearch, 'Orders[m_system_tantou_id]')) {

                $this->paginate['conditions']['Orders.m_system_tantou_id'] = $strValue;
            }

            // ekurashi - 案件検索画面：default search condition
            if ($value = $this->validAryKey($pArySearch, 'orders_joutaikubun_not_in')) {
                $this->paginate['conditions']['Orders.m_system_joutaikubun_id not in'] = explode(",", $value);
            }

            //登録日
            if ($value = $this->validAryKey($pArySearch, 'created_from')) {
                $this->paginate['conditions']['Project.created >='] = $value;
            }
            if ($value = $this->validAryKey($pArySearch, 'created_to')) {
                $this->paginate['conditions']['Project.created <='] = $value;
            }
            //受注日
            if ($value = $this->validAryKey($pArySearch, 'juchuu_from')) {
                $this->paginate['conditions']['Orders.created >='] = $value;
            }
            if ($value = $this->validAryKey($pArySearch, 'juchuu_to')) {
                $this->paginate['conditions']['Orders.created <='] = $value;
            }
            //TODO: 作業予定日
            if ($value = $this->validAryKey($pArySearch, 'is_kensaku')) {
                $arySearchEqual = [
                    'm_system_shiharaihouhou_id', 'm_mediation_gensen_id',
                    'shiharai_saki_kubun', 'm_system_kamoku_id'
                ];
                foreach ($arySearchEqual as $searchKey) {
                    if($strValue = $this->validAryKey($pArySearch, $searchKey)) {
                        $this->paginate['conditions']["Project.$searchKey"] = $strValue;
                    }
                }

                if($strValue = $this->validAryKey($pArySearch, 'm_system_tantou_id')) {

                    $this->paginate['conditions']['Orders.m_system_tantou_id'] = $strValue;
                }
            }
        }

        return $this->Orders->find()->where(['Orders.deleted is' => null]);
    }

    public function kizonHenshuuIchiran() {
        $this->ankenKensaku();
    }

    public function ankenKensaku() {
        $mstSystem = $this->getMstSystem($this->generateConditionForTouroku());

        $aryTantousha = isset($mstSystem[MSystemTable::SYSTEM_TANTOUSHA]) ? $mstSystem[MSystemTable::SYSTEM_TANTOUSHA] : [];
        $aryBumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID]) ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID] : [];
        $aryShiharai = isset($mstSystem[MSystemTable::SYSTEM_SHIHARAI_HOUHOU]) ? $mstSystem[MSystemTable::SYSTEM_SHIHARAI_HOUHOU] : [];
        $aryKamoku = isset($mstSystem[MSystemTable::SYSTEM_KAMOKU_ID]) ? $mstSystem[MSystemTable::SYSTEM_KAMOKU_ID] : [];
        $aryMediation = $this->MstService->getGensen();
        $defaultCondition = [
            'orders_joutaikubun_not_in' => OrderDetailTable::JOUTAI_KUBUN_IKKATSU_KEIJOU. "," . OrderDetailTable::JOUTAI_KUBUN_BUNKATSU_KEIJOU
                . "," . OrderDetailTable::JOUTAI_KUBUN_KANRYOU_KAKUNIN_NOMI. "," . OrderDetailTable::JOUTAI_KUBUN_KURIGAMI_KEIJOU
        ];
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $query = $this->ankenKensakuCondition();
            $objOrders = $this->paginate($query);
            $result = [];
            foreach ($objOrders as $key => $objOrderItem) {
                $aryProject = $objOrderItem->project;
                //$strUrlEdit = ($aryProject['type'] == ProjectTable::YOTEI_TYPE) ? 'yoteiHenshuu' : 'kakuteiHenshuu';
                $bumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']])
                    ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID][$aryProject['m_system_bumon_id']]
                    : '';
                $result[$key][] = $this->tableActionField($objOrderItem->id, [
                    'controller' => 'Project',
                    'action' => $this->getShoriAction($aryProject)
                ]);
                $result[$key][] = $aryProject['bangou'];
                $result[$key][] = $objOrderItem->juchuu_bangou;
                $result[$key][] = $aryProject['e_moushisha_mei'];
                $result[$key][] = $bumon;
                $result[$key][] = Utility::dateFull($objOrderItem->modified);
            }

            $this->datatableResponse($query, $result);
        }

        $this->set(compact('mstSystem', 'aryTantousha', 'aryBumon', 'aryShiharai', 'aryKamoku', 'aryMediation','defaultCondition'));
    }

    /**
     * Type: action
     * Method: post|ajax
     */
    public function exportCsvAnkenKensaku() {
        if ($this->request->is('ajax')) {
            $mstSystem = $this->getMstSystem([
                'MSystem.type_name' => MSystemTable::SYSTEM_BUMON_ID
            ]);
            $aryBumon = isset($mstSystem[MSystemTable::SYSTEM_BUMON_ID]) ? $mstSystem[MSystemTable::SYSTEM_BUMON_ID] : [];

            $query = $this->ankenKensakuCondition();
            $objData = $this->paginate($query);

            //header
            $aryData[] = [
                '案件番号',
                '受注番号',
                '申込者名',
                '部門',
                '更新日'
            ];
            //content
            foreach ($objData as $key => $objOrderItem) {
                $aryProject = $objOrderItem->project;
                $aryData[] = [
                    $aryProject['bangou']
                    ,$objOrderItem->juchuu_bangou
                    ,$aryProject['e_moushisha_mei']
                    ,isset($aryBumon[$aryProject['m_system_bumon_id']]) ? $aryBumon[$aryProject['m_system_bumon_id']] : ''
                    ,Utility::dateFull($objOrderItem->modified)
                ];
            }

            $this->exportCsvResponse($aryData,'案件_出力');
        }
    }

    private function getJoutaiKubun($mstSystem = []) {
        $strDefault = '受注済';
        $aryResult = [];
        if(isset($mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN])) {
            $arySystemJoutaiKubun = $mstSystem[MSystemTable::SYSTEM_JOUTAI_KUBUN];
            if(in_array($strDefault, $arySystemJoutaiKubun)) {
                $key = array_search($strDefault, $arySystemJoutaiKubun);
                $aryResult[$key] = $strDefault;
            }
        }

        return $aryResult;
    }

    public function getProject() {
        $this->autoRender = false;
        $aryResult = ['success' => false];
        if ($this->request->is(['ajax', 'post'])) {
            $aryProduct = $this->request->getData('ary_product', []);
            $aryProductQuantity = $this->request->getData('ary_product_quantity', []);
            if(!$aryProduct || !$aryProductQuantity) {
                $aryResult['message'] = sprintf(Message::INVALID_PARAM);
                $this->jsonResponse($aryResult);
            }

            $aryClientProduct = [];
            foreach ($aryProduct as $key => $intProductItem) {
                if(isset($aryClientProduct[$intProductItem])) {
                    $aryClientProduct[$intProductItem] += (int)$aryProductQuantity[$key];
                } else {
                    $aryClientProduct[$intProductItem] = (int)$aryProductQuantity[$key];
                }
            }

            $aryProject = $this->MProduct->find()
                ->select(['id', 'mei', 'koudo', 'ekisei_zaiko_suuryou'])
                ->where([
                    'id in' => $aryProduct,
                    'ekisei_zaiko_suuryou > 0',
                    'deleted is null'
                ])->toArray();

            if(!$aryProject) {
                $aryResult['message'] = sprintf(Message::FIELD_NOT_FOUND, '商品');
                $this->jsonResponse($aryResult);
            }

            $aryError = [];
            foreach ($aryProject as $projectItem) {
                $intId = $projectItem['id'];
                $intZaikoSuuryou = $projectItem['ekisei_zaiko_suuryou'];
                if(isset($aryClientProduct[$intId]) && ($intQuantity = $aryClientProduct[$intId])) {
                    if($intQuantity > $intZaikoSuuryou) {
                        $aryError[] = $projectItem['koudo'] . 'ー' . $projectItem['mei'];
                    }
                }
            }

            if($aryError) {
                $aryResult['message'] = '「'.implode('、', $aryError) . '」製品一覧で製品の入力が大きい';
            } else {
                $aryResult['message'] = '';
            }
            $aryResult['success'] = true;
        } else {
            $aryResult['message'] = sprintf(Message::INVALID_PARAM);
        }

        $this->jsonResponse($aryResult);
    }

    public function kanryouHenkouShouhin() {
        $this->autoRender = false;
        $aryResult = ['success' => false];
        if ($this->request->is(['ajax', 'post'])) {
            $aryId = $this->request->getData('ary_id', []);
            $arySuuryou = $this->request->getData('ary_suuryou', []);
            $aryhatchuuTanka = $this->request->getData('ary_hatchuu_tanka', []);
            $aryhatchuuKingaku = $this->request->getData('ary_hatchuu_kingaku', []);
            $aryhenkouJiyuu = $this->request->getData('ary_henkou_jiyuu', []);
            $strTokukijikou = $this->request->getData('tokukijikou');

            if(!$aryId || !$arySuuryou || !$aryhatchuuTanka || !$aryhatchuuKingaku || !$aryhenkouJiyuu) {
                $aryResult['message'] = sprintf(Message::INVALID_PARAM);
                $this->jsonResponse($aryResult);
            }

            $aryOrderDetail = $this->OrderDetail->find()
                ->where([
                    'id in' => $aryId, 'deleted is null'
                ])->toArray();

            if(count($aryOrderDetail) <= 0) {
                $aryResult['message'] = sprintf(Message::FIELD_NOT_FOUND, '商品');
                $this->jsonResponse($aryResult);
            }

            $aryDebugUpdate = [];
            foreach ($aryId as $key => $itemId) {
                $aryDebugUpdate[$itemId] = [
                    'suuryou' => $arySuuryou[$key],
                    'hatchuu_tanka' => $aryhatchuuTanka[$key],
                    'hatchuu_kingaku' => $aryhatchuuKingaku[$key],
                    'henkou_jiyuu' => $aryhenkouJiyuu[$key],
                    'tokukijikou' => $strTokukijikou ? $strTokukijikou : null
                ];
            }

            $aryUpdate = [];
            foreach ($aryOrderDetail as $key => $orderDetailItem) {
                if(isset($aryDebugUpdate[$orderDetailItem->id]) && ($item = $aryDebugUpdate[$orderDetailItem->id])) {
                    if($item['suuryou'] != $orderDetailItem->suuryou) {
                        $aryUpdate[$orderDetailItem->id]['suuryou'] = $item['suuryou'];
                    }
                    if($item['hatchuu_tanka'] != $orderDetailItem->hatchuu_tanka) {
                        $aryUpdate[$orderDetailItem->id]['hatchuu_tanka'] = $item['hatchuu_tanka'];
                    }
                    if($item['hatchuu_kingaku'] != $orderDetailItem->hatchuu_kingaku) {
                        $aryUpdate[$orderDetailItem->id]['hatchuu_kingaku'] = $item['hatchuu_kingaku'];
                    }
                    if($item['henkou_jiyuu'] != $orderDetailItem->hatchuu_kingaku) {
                        $aryUpdate[$orderDetailItem->id]['henkou_jiyuu'] = $item['henkou_jiyuu'];
                    }
                    if($item['tokukijikou'] != $orderDetailItem->tokukijikou) {
                        $aryUpdate[$orderDetailItem->id]['tokukijikou'] = $item['tokukijikou'];
                    }
                }
            }

            $aryError = [];
            if($aryUpdate) {
                foreach ($aryUpdate as $id => $itemUpdate) {
                    $poStatus = $this->OrderDetail->updateAll($itemUpdate + ['modified' => Utility::dbDate()], ['id' => $id]);
                    if($poStatus) $aryError[] = $id;
                }
            }

            $aryResult['data']['error_id'] = $poStatus;
            $aryResult['success'] = true;
        } else {
            $aryResult['message'] = sprintf(Message::INVALID_PARAM);
        }

        $this->jsonResponse($aryResult);
    }
}
