<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MSystem Controller
 *
 * @property \App\Model\Table\LogLoginTable $LogLogin
 *
 * @method \App\Model\Entity\MSystem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LogController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {

    }

    public function logLoginList()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder(0);//order

            //get all param search
            $pArySearch = $this->getQuerySearch();

            //search
//            if($pArySearch) {
//                //= search condition
//                if($value = $this->validAryKey($pArySearch, 'type_name')) {
//                    $this->paginate['conditions']['MSystem.type_name'] = $value;
//                }
//            }

            $query = $this->LogLogin->find() ;
            $mSystems = $this->paginate($query);

            $result = [];
            foreach ($mSystems as $key => $mSystem) {
                $result[$key][] = date("Y/m/d H:i:s", strtotime($mSystem->created));
                $result[$key][] = $mSystem->m_user_name;
                $result[$key][] = $mSystem->m_user_username;
                $result[$key][] = $mSystem->m_supplier_name;
                $result[$key][] = date("Y/m/d H:i:s", strtotime($mSystem->m_user_created));
            }

            $this->datatableResponse($query, $result);
        }
    }

    public function logProjectList()
    {
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->paginate = $this->getPaginateConfig();
            $this->paginate['order'] = $this->getQueryOrder(0);//order

            $query = $this->LogUpdateProject->find()->contain("MUser");
            $logs = $this->paginate($query);

            $result = [];
            foreach ($logs as $key => $log) {
                // $result[$key][] = $log->m_user_id;
                $result[$key][] = $log->m_user->username;
                $result[$key][] = $log->order_id;
                $result[$key][] = $log->bangou;
                $result[$key][] = $log->status;
                $result[$key][] = date("Y/m/d H:i:s", strtotime($log->created));

            }

            $this->datatableResponse($query, $result);
        }
    }
}
