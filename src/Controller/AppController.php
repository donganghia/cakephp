<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Controller;

use App\Libs\Constant;
use App\Libs\Crypt;
use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;
use App\Libs\Message;
use App\Libs\Utility;
/**
 * Add Component
 * @property \App\Controller\Component\ExcelServiceComponent $ExcelService
 * @property \App\Controller\Component\CsvServiceComponent $CsvService
 * @property \App\Controller\Component\MstServiceComponent $MstService
 * @property \App\Controller\Component\MailServiceComponent $MailService
 *
 * Add Model Table
 * @property \App\Model\Table\MUserTable $MUser
 * @property \App\Model\Table\MProductTable $MProduct
 * @property \App\Model\Table\MSupplierTable $MSupplier
 * @property \App\Model\Table\MSupplierProductTable $MSupplierProduct
 * @property \App\Model\Table\MRoleTable $MRole
 * @property \App\Model\Table\MSystemTable $MSystem
 * @property \App\Model\Table\MCustomerTable $MCustomer
 * @property \App\Model\Table\MCustomerTable $MMediation
 * @property \App\Model\Table\LogLoginTable $LogLogin
 * @property \App\Model\Table\LogUpdateProjectTable $LogUpdateProject
 * @property \App\Model\Table\ProjectTable $Project
 * @property \App\Model\Table\OrdersTable $Orders
 * @property \App\Model\Table\OrderDetailTable $OrderDetail
 * @property \App\Model\Table\OrderAttachedFileTable $OrderAttachedFile
 * @property \App\Model\Table\OrderNotificationTable $OrderNotification
 * @property \App\Model\Table\OrderCommentTable $OrderComment
 * @property \App\Model\Table\MCustomerHistoryTable $MCustomerHistory
 */
class AppController extends Controller
{
    static public $strControllerName;
    static public $strActionName;
    static public $strRoute;
    static public $aryLoginUser;

    const STATUS_SUCCESS = 1;
    const STATUS_ERROR = -1;

    public function initialize()
    {
        parent::initialize();

        //Add Model Table
        $this->loadModel('LogLogin');
        $this->loadModel('LogUpdateProject');
        $this->loadModel('MProduct');
        $this->loadModel('MUser');
        $this->loadModel('MSupplier');
        $this->loadModel('MSupplierProduct');
        $this->loadModel('MRole');
        $this->loadModel('MSystem');
        $this->loadModel('MCustomer');
        $this->loadModel('MMediation');
        $this->loadModel('Project');
        $this->loadModel('Orders');
        $this->loadModel('OrderDetail');
        $this->loadModel('OrderAttachedFile');
        $this->loadModel('OrderNotification');
        $this->loadModel('OrderComment');
        $this->loadModel('OrderCommentDetail');
        $this->loadModel('MCustomerHistory');

        //Add Component
        $this->loadComponent('ExcelService');
        $this->loadComponent('CsvService');
        $this->loadComponent('MstService');
        $this->loadComponent('MailService');

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'autoRedirect' => FALSE,
            'loginAction' => Constant::$ROUTE_LOGIN,
            'loginRedirect' => Constant::$ROUTE_LOGIN_REDIRECT,
            'logoutRedirect'=> Constant::$ROUTE_LOGOUT_REDIRECT,
            'unauthorizedRedirect' => Constant::$ROUTE_LOGIN,
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password',
                    ],
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
                    'userModel' => 'MUser',
                    'finder' => 'auth'
                ]
            ],
            'storage' => 'Session',
            'authorize' => ['Controller'],
            'authError' => __('その場所にアクセスする権限がありません。')
        ]);

        self::$strControllerName = strtolower($this->request->getParam('controller'));
        self::$strActionName = strtolower($this->request->getParam('action'));
        self::$strRoute = self::$strControllerName.'.'.self::$strActionName;

        //auto login if having session
        if ($this->Auth->user() && self::$strRoute === 'auth.login') {
            return $this->redirect(Constant::$ROUTE_LOGIN_REDIRECT);
        }

        $this->request->trustProxy = true;
        $this->response->withDisabledCache();
    }

    /**
     * @param Event $event
     * @return \Cake\Network\Response|null|void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        self::$aryLoginUser = $this->Auth->user();

        $this->set('aryLoginUser', self::$aryLoginUser);
    }

    /**
     * @return bool
     */
    public function isAuthorized() {
        return true;
//        return false;
    }

    /**
     * @param array || string $errors
     */
    public function errorFlash($error) {
        $this->Flash->error($error, ['key' => 'error']);
    }

    /**
     * @param array || string $errors
     */
    public function successFlash($success) {
        $this->Flash->success($success, ['key' => 'success']);
    }

    /**
     * @param  mixed $success
     *
     * @return void
     */
    public function successAlertFlash($success) {
        $this->Flash->successAlert($success, ['key' => 'alert_success']);
    }

    /**
     * @param array || string $msg
     */
    public function msgFlash($msg) {
        $this->Flash->msg($msg, ['key' => 'msg']);
    }

    /**
     * @param string
     * @return array
     */
    public function getPaginateConfig($start = null) {
        if(!$start) {
            $start = (int)$this->getRequest()->getQuery('start', 0);
        }
        $limit = Constant::PAGE_LENGTH;
        return [
            'page' => $this->getCurrentPage($start, $limit),
            'limit' => $limit
        ];
    }

    /**
     * @param $start
     * @param $limit
     * @return float|int
     */
    public function getCurrentPage($start, $limit) {

        return $start > 0 && $limit > 0 ? $start/$limit + 1 : 1;
    }

    /**
     * @param $recordId
     * @param array $aryUrlEdit
     * @param array $aryUrlDelete
     * @return string
     */
    public function tableActionField($recordId, $aryUrlEdit = [], $aryUrlDelete = []) {
        $recordId = Crypt::encrypAES($recordId);
        $urlEdit = Router::url($aryUrlEdit + [$recordId]);
        $strHtml = '<a href="'.$urlEdit.'"><i class="fa fa-edit fa-lg"></i></a>';
        if($aryUrlDelete) {
            $urlDelete = Router::url($aryUrlDelete + [$recordId]);
            $urlDelete = "'$urlDelete'";
            $strHtml .= '&nbsp;<i onclick="tableDelete('.$urlDelete.');" class="fa fa-trash fa-lg text-danger"></i>';
        }

        return "<div class='actions'>$strHtml</div>";
    }

    public function encrypAES($id) {
        return Crypt::encrypAES($id);
    }

    /**
     * @param $obj
     * @return string
     */
    public function tableCheckboxField($obj) {
        return '<input type="checkbox" name="id[]" value="'.$obj->id.'" id="id-'.$obj->id.'">';
    }

    /**
     * @param $obj
     * @param $encode
     * @return string
     */
    public function tableRadioField($obj, $encode = false) {
        $recordId = $encode ? Crypt::encrypAES($obj->id) : $obj->id;
        return '<input type="radio" name="id[]" value="'.$recordId.'" id="id-'.$obj->id.'">';
    }

    /**
     * @return array
     */
    public function getQuerySearch() {
        $pStrSearch = $this->getRequest()->getQuery('search', '');
        $aryResult = [];

        if(isset($pStrSearch['value']) && ($strValue = $pStrSearch['value'])) {
            $aryData = explode('&', $strValue);
            foreach ($aryData as $dataItem) {
                list($strField, $value) = explode('=', $dataItem);
                if(!in_array($strField, ['_method', '_csrfToken'])) {
                    $value = urldecode($value);
                    $field = urldecode($strField);
                    $aryField = explode('[]', $field);
                    if(count($aryField) >= 2) {
                        $aryResult[$aryField[0]][] = $value;
                    } else {
                        $aryResult[$field] = $value;
                    }
                }
            }
        }

        return $aryResult;
    }

    /**
     * @param $object
     * @return array
     */
    public function checkDataAccess($object) {
        if(!$object) {
            $this->Flash->error(Message::PERMISSION_DENIED);
            return $this->redirect($this->Auth->redirectUrl());
        }
        return true;
    }


    /**
     * @param int $intDefaultColumn
     * @return array
     */
    public function getQueryOrder($intDefaultColumn = 0) {
        $pOrderIndex = (int)$this->getRequest()->getQuery('order.0.column', $intDefaultColumn);
        $pOrderDir = $this->getRequest()->getQuery('order.0.dir', 'desc');
        $pOrderField = $this->getRequest()->getQuery("columns.$pOrderIndex.name", '');

        return strpos('action', $pOrderField) === false ? [$pOrderField => $pOrderDir]
            : [str_replace('action', 'modified', $pOrderField) => $pOrderDir];
    }

    public function validAryKey($ary, $key) {
        $poValue = '';
        if(isset($ary[$key]) && ($value = $ary[$key])) {
            $poValue = $value;
        }
        return $poValue;
    }

    /**
     * @param $query
     * @param $aryResult
     * @param array $aryOption
     */
    public function datatableResponse($query, $aryResult, $aryOption = []) {
        $aryData = [
            'draw' => 0,
            'recordsTotal' => $query->count(),
            'recordsFiltered' => $query->count(),
            'data' => $aryResult
        ];

        if($aryOption) {
            $aryData += $aryOption;
        }

        echo json_encode($aryData);die;
    }

    /**
     * @param $aryResult
     * @param array $aryOption
     */
    public function jsonResponse($aryResult, $aryOption = []) {
        $aryData = $aryResult;

        if($aryOption) {
            $aryData += $aryOption;
        }

        echo json_encode($aryData);die;
    }


    /**
     * @param $recordId
     * @return string
     */
    public function buttonAjaxAction($recordId) {
        $strHtml = '';
        $strHtml .= '&nbsp;<i name="btn-edit-record" class="fa fa-edit fa-lg text-info" onclick="ajaxAddEditData('.$recordId.');" ></i>';
        $strHtml .= '&nbsp;<i  class="fa fa-trash fa-lg text-danger" onclick="ajaxDeleteData('.$recordId.');" ></i>';

        return "<div class='actions'>$strHtml</div>";
    }

    /**
     * View method
     *
     * @param $condition
     * @return array |null
     */
    public function getMstSystem($condition)
    {
        $result = $this->MSystem->find('all', array(
            'conditions' => array_merge($condition, ['MSystem.deleted is' => null])
        ));
        $output = [];
        foreach ($result as $r) {
            $output[$r->type_name][$r->id] = $r->name;
        }
        return $output;
    }

    /**
     * @param $aryData
     * @param $fileName
     */
    public function exportCsvResponse($aryData, $fileName) {
        $str = '';

        foreach ($aryData as $key => $row) {
            $str .= implode(",", $row) ."\r\n";
        }

        echo json_encode([
            'csvData' => $str,
            'fileName' => Utility::csvName($fileName),
        ]);die;
    }

    public function utf8EncodeAll($data)
    {
        if(!empty($data)) {
            foreach ($data as &$v) {
                $v = mb_convert_encoding($v, "UTF-8", "UTF-8, SJIS");
            }
        }
        return $data;
    }

    /**
     * CSV build method
     *
     * @param $Files
     * @return array |null
     */
    public function getCsvToArray($Files)
    {
        if (!empty($Files)) {
            $inputFile = $Files['name'];
            $extension = strtoupper(pathinfo($inputFile, PATHINFO_EXTENSION));
            if ($extension == 'csv' || $extension == 'CSV') {
                    $inputFile = $Files['tmp_name'];

                    $file = fopen($inputFile, "r");
                    $data = [];
                    while (!feof($file)) {
                        $_data = $this->utf8EncodeAll(fgetcsv($file));
                        if($_data) $data[] = $_data;
                    }
                    fclose($file);

                    //remove header
                    unset($data[0]);

                    if(!empty($data)) {
                        return [
                            self::STATUS_SUCCESS,
                            null,
                            $data
                        ];
                    } else {
                        return [
                            self::STATUS_ERROR,
                            Utility::validMsg(Message::INCORRECT, ['データー']),
                            null
                        ];
                    }
            } else {
                return [
                    self::STATUS_ERROR,
                    Utility::validMsg(Message::INCORRECT, ['ファイル']),
                    null
                ];
            }
        } else {
            return [
                self::STATUS_ERROR,
                Utility::validMsg(Message::INCORRECT, ['データー']),
                null
            ];
        }
    }

    /**
     * @param $id
     * @return value
     */
    public function getSupplierName($id) {
        if(empty($id)) {
            return null;
        }
        $mSupplier = $this->MSupplier->get($id, [
            'contain' => []
        ]);

        return $mSupplier ? $mSupplier->mei_1 : null;
    }

    /**
     * View method
     *
     * @return array |null
     */
    public function getMstSupplier()
    {
        $result = $this->MSupplier->find('all')
            ->select(['id', 'mei_1'])
            ->where(['deleted is' => null])
            ->toArray();
        $output = [];
        foreach ($result as $mSupplier) {
            $output[$mSupplier->id] = $mSupplier->mei_1;
        }

        return $output;
    }

    /**
     * View method
     * @param array| null $conditions
     *
     * @return array |null
     */
    public function getMstSupplierProduct($conditions = null)
    {
        $result = $this->MSupplierProduct->find('all')
            ->select([
                'MSupplier.koudo', 'id', 'shouhin_mei'
            ])
            ->where(['MSupplierProduct.deleted is' => null])
            ->innerJoinWith('MSupplier', function ($query) use($conditions) {
                return $conditions ? $query->where($conditions) : $query;
            })->toArray();
        $output = [];
        foreach ($result as $mSupplierProduct) {
            $mSupplier = $mSupplierProduct->_matchingData['MSupplier'];
            $output[$mSupplierProduct->id] = $mSupplier->koudo.' ' . $mSupplierProduct->shouhin_mei;
        }

        return $output;
    }
}
