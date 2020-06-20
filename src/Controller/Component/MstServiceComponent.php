<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace App\Controller\Component;

use Cake\Controller\Controller;
use Cake\Controller\Component;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Class MstServiceComponent
 * @package App\Controller\Component
 *
 * @property \App\Model\Table\MMediationTable $MMediation
 * @property \App\Model\Table\MProductTable $MProduct
 * @property \App\Model\Table\MSupplierTable $MSupplier
 * @property \App\Model\Table\MCustomerTable $MCustomer
 */

class MstServiceComponent extends Component {

    public function initialize(array $config) {
        parent::initialize($config);

//        $this->controller = $this->_registry->getController();
        $this->MMediation = TableRegistry::getTableLocator()->get('MMediation');
        $this->MProduct = TableRegistry::getTableLocator()->get('MProduct');
        $this->MSupplier = TableRegistry::getTableLocator()->get('MSupplier');
        $this->MCustomer = TableRegistry::getTableLocator()->get('MCustomer');
    }

    /**
     * @return array
     */
    public function getGensen() {
        return $this->MMediation
            ->find('list', ['order' => ['created' => 'DESC']])
            ->where(['deleted is' => null])->toArray();
    }

    /**
     * @return array
     */
    public function cntProduct() {
        return $this->countMst('MProduct');
    }

    /**
     * @return array
     */
    public function cntSupplier() {
        return $this->countMst('MSupplier');
    }

    /**
     * @return array
     */
    public function cntCustomer() {
        return $this->countMst('MCustomer');
    }

    private function countMst($strTableName) {
        return $this->{$strTableName}
            ->find('list', ['order' => ['created' => 'DESC']])
            ->where(['deleted is' => null])->count();
    }
}