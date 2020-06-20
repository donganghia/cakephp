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
class LogLoginController extends AppController
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
                if($value = $this->validAryKey($pArySearch, 'type_name')) {
                    $this->paginate['conditions']['MSystem.type_name'] = $value;
                }
            }

            $query = $this->MSystem->find()
                ->where(['MSystem.deleted is' => null]) ;
            $mSystems = $this->paginate($query);

            $result = [];
            foreach ($mSystems as $key => $mSystem) {
                $result[$key][] = $this->buttonAjaxAction($mSystem->id);
                $result[$key][] = $mSystem->id;
                $result[$key][] = $mSystem->name;
                $result[$key][] = date("Y/m/d H:i:s", strtotime($mSystem->modified));
            }

            $this->datatableResponse($query, $result);
        }
    }

    public function add()
    {
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');
            $mSystem = $id == 0
                ? $this->MSystem->newEntity()
                : $this->MSystem->get($id, [
                    'contain' => []
                ]);
            if($id == 0)
                $mSystem->type_name = $this->request->getData('type_name');
            $this->set(compact( 'mSystem'));

            echo $this->render('add'); die;
        }
    }

    public function save()
    {
        if ($this->request->is('ajax')) {
            $id = $this->request->getData('id');

            $mSystem = $id == 0
                ? $this->MSystem->newEntity()
                : $this->MSystem->get($id, [
                    'contain' => []
                ]) ;
            $mSystem = $this->MSystem->patchEntity($mSystem, $this->request->getData());
            if ($this->MSystem->save($mSystem)) {
                echo json_encode([
                    'msg' => __('The m system has been saved.'),
                    'status' => self::STATUS_SUCCESS
                ]); die;
            }
            echo json_encode([
                'msg' => __('The m system could not be saved. Please, try again.'),
                'status' => self::STATUS_ERROR
            ]); die;
        }
    }
}
