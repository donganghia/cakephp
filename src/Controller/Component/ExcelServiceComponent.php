<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\Controller;
use App\Libs\Constant;

class ExcelServiceComponent extends Component {

    /* @var Controller */
    public $controller;

    public function initialize(array $config) {
        parent::initialize($config);

        //Accessing a Component’s Controller
        $this->controller = $this->_registry->getController();
    }

    public static function loadExcelForm($fileName) {
        try {
            $strPath = Constant::EXCEL_TEMPLATE_PATH.$fileName;

            return \PHPExcel_IOFactory::load($strPath);
        } catch (\PHPExcel_Reader_Exception $e) {
            echo 'Load PHPExcel_IOFactory fail';die;
        }
    }
}