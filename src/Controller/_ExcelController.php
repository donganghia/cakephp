<?php
namespace App\Controller;

use App\Libs\Constant;
use App\Libs\Crypt;
use App\Libs\Message;
use App\Libs\Utility;
use App\Model\Table\MProductTable;
use App\Model\Table\MSystemTable;
use PHPExcel_Style_Alignment;

class ExcelController extends AppController
{

    const ARY_EKURASHI_INFO = [
        'address' => '〒464-0075　愛知県名古屋市千種区内山3丁目30番9号'
        ,'tel' => 'TEL　052-744-0271'
        ,'fax' => 'FAX　052-744-0274'
        ,'free' => 'フリーダイヤル　0120-667-539'
        ,'name' => '代表取締役　　大谷　真哉'
    ];

    /**
     * @param null $orderId
     * @return \Cake\Http\Response|null
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function exportMitsumori($orderId = null) {
        $orderId = Crypt::decryptAES($orderId);
        $objOrder = $this->Orders->find()
            ->select([
                'Orders.id',
                'Orders.created',
                'zeiritsu' => 'p.zeiritsu',
                'm_customer_id' => 'p.m_customer_id',
                'tokui_saki_mei1' => 'mc.tokui_saki_mei1',
                'tokui_saki_mei2' => 'mc.tokui_saki_mei2'
            ])
            ->where(['Orders.id' => $orderId, 'Orders.deleted is null'])
            ->join([
                'table' => 'project',
                'alias' => 'p',
                'type' => 'LEFT',
                'conditions' => 'Orders.project_id = p.id'
            ])
            ->join([
                'table' => 'm_customer',
                'alias' => 'mc',
                'type' => 'LEFT',
                'conditions' => 'p.m_customer_id = mc.id'
            ])
            ->first();

        if(!$objOrder) {
            $this->errorFlash(Utility::validMsg(Message::FIELD_NOT_FOUND, ['オーダー']));
            return $this->redirect(['controller' => 'Menu', 'action' => 'juchuuTouroku']);
        }

        $objCustomer = $this->MCustomer->find()
            ->select(['tokui_saki_mei1', 'tokui_saki_mei2'])
            ->where(['id' => $objOrder['m_customer_id'], 'deleted is null'])
            ->first();

        $strCustomerName = $objCustomer['tokui_saki_mei1'].$objCustomer['tokui_saki_mei2'].'　様';

        $aryOrderDetail = $this->OrderDetail->find()
            ->select([
                'product_name' => 'mp.mei'
                ,'product_koudo' => 'mp.koudo'
                ,'tani' => 'OrderDetail.tani'
                ,'suuryou' => 'OrderDetail.suuryou'
                ,'hatchuu_tanka' => 'OrderDetail.hatchuu_tanka'
                ,'hatchuu_kingaku' => 'OrderDetail.hatchuu_kingaku'
                ,'juchuu_tanka' => 'OrderDetail.juchuu_tanka'
                ,'juchuu_kingaku' => 'OrderDetail.juchuu_kingaku'
                ,'gentanka' => 'sp.tanka'
            ])
            ->where(['order_id' => $objOrder->id])
            ->join([
                'table' => 'm_product',
                'alias' => 'mp',
                'type' => 'LEFT',
                'conditions' => 'mp.id = OrderDetail.m_product_id'
            ])
            ->join([
                'table' => 'm_supplier_product',
                'alias' => 'sp',
                'type' => 'LEFT',
                'conditions' => 'sp.id = mp.m_supplier_product_id'
            ])
            ->orderDesc('OrderDetail.id')
            ->toArray();

        if(count($aryOrderDetail) < 1) {
            echo '商品がまだ追加されません。';
            die;
        }

        $objPHPExcel = $this->loadExcelForm('mitsumori.xlsx');

        $aryHeader = self::ARY_EKURASHI_INFO;

        $objPHPExcel->getActiveSheet()->setCellValue('K5', Utility::dateUI($objOrder->created));
        $objPHPExcel->getActiveSheet()->setCellValue('B6', $strCustomerName);
        $objPHPExcel->getActiveSheet()->setCellValue('I8', $aryHeader['address']);
        $objPHPExcel->getActiveSheet()->setCellValue('I9', $aryHeader['tel']);
        $objPHPExcel->getActiveSheet()->setCellValue('K9', $aryHeader['fax']);
        $objPHPExcel->getActiveSheet()->setCellValue('I10', $aryHeader['free']);
        $objPHPExcel->getActiveSheet()->setCellValue('I11', $aryHeader['name']);
        $objPHPExcel->getActiveSheet()->setCellValue('R23', $objOrder['zeiritsu']/100);
        $intStartRow = 24;
        $intExtentRow = $intStartRow + 11;

        foreach ($aryOrderDetail as $key => $orderDetailItem) {
            if($intStartRow >= $intExtentRow) {
                //insert rows
                $intNewRow = $intStartRow + 1;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($intNewRow, 1);
                $objPHPExcel->getActiveSheet()
                    ->getStyle("J$intNewRow:L$intNewRow")
                    ->getAlignment()
                    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
            }
            $strTani = isset(MProductTable::TANI_VALUE[$orderDetailItem['tani']]) ? MProductTable::TANI_VALUE[$orderDetailItem['tani']] : '';
            $objPHPExcel->getActiveSheet()->setCellValue("B$intStartRow", $orderDetailItem['product_name']);
            $objPHPExcel->getActiveSheet()->setCellValue("F$intStartRow", $orderDetailItem['suuryou']);
            $objPHPExcel->getActiveSheet()->setCellValue("G$intStartRow", $strTani);
            $objPHPExcel->getActiveSheet()->setCellValue("H$intStartRow", $orderDetailItem['juchuu_tanka']);
            $objPHPExcel->getActiveSheet()->setCellValue("I$intStartRow", $orderDetailItem['juchuu_kingaku']);
            $objPHPExcel->getActiveSheet()->setCellValue("M$intStartRow", $orderDetailItem['hatchuu_kingaku']);
            $objPHPExcel->getActiveSheet()->setCellValue("N$intStartRow", 0);
            $objPHPExcel->getActiveSheet()->setCellValue("O$intStartRow", "=I$intStartRow-M$intStartRow");
            $objPHPExcel->getActiveSheet()->setCellValue("P$intStartRow", "=IF(I$intStartRow<=0, 0, O$intStartRow/I$intStartRow)");
            $objPHPExcel->getActiveSheet()->setCellValue("Q$intStartRow", "=IF(N$intStartRow<=0, 0, 1-H$intStartRow/N$intStartRow)");

            $intStartRow++;
        }

        $this->excelResponse($objPHPExcel, '見積書.xlsx');
    }

    /**
     * @param null $orderId
     * @return \Cake\Http\Response|null
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Writer_Exception
     */
    public function exportHatchuusho($orderId = null) {

        $orderId = Crypt::decryptAES($orderId);
        $objOrder = $this->Orders->find()->contain(['Project'])
            ->where(['Orders.id' => $orderId, 'Orders.deleted is' => null])
            ->first();

        if(!$objOrder) {
            $this->errorFlash(Utility::validMsg(Message::FIELD_NOT_FOUND, ['オーダー']));
            return $this->redirect(['controller' => 'Menu', 'action' => 'juchuuTouroku']);
        }

        $aryOrderDetail = $this->OrderDetail->find()
            ->select([
                'product_name' => 'mp.mei'
                ,'product_koudo' => 'mp.koudo'
                ,'tani' => 'OrderDetail.tani'
                ,'suuryou' => 'OrderDetail.suuryou'
                ,'hatchuu_tanka' => 'OrderDetail.hatchuu_tanka'
                ,'hatchuu_kingaku' => 'OrderDetail.hatchuu_kingaku'
                ,'juchuu_tanka' => 'OrderDetail.juchuu_tanka'
                ,'juchuu_kingaku' => 'OrderDetail.juchuu_kingaku'
            ])
            ->where(['order_id' => $objOrder->id])
            ->join([
                'table' => 'm_product',
                'alias' => 'mp',
                'type' => 'LEFT',
                'conditions' => 'mp.id = OrderDetail.m_product_id'
            ])->toArray();

        if(count($aryOrderDetail) < 1) {
            echo '商品がまだ追加されません。';
            die;
        }

        $aryProject = $objOrder->project;
        $intZeiritsu = $aryProject['zeiritsu'];
        $aryMstSystem = $this->getMstSystem([
            'MSystem.id' => $aryProject['m_system_tantousha_id']
        ]);

        $strTantoName = '';
        if(isset($aryMstSystem[MSystemTable::SYSTEM_TANTOUSHA][$aryProject['m_system_tantousha_id']])) {
            $strTantoName = $aryMstSystem[MSystemTable::SYSTEM_TANTOUSHA][$aryProject['m_system_tantousha_id']];
            $strTantoName.='　様';
        }

        $objPHPExcel = $this->loadExcelForm('hatchuusho.xlsx');

        /*$aryHeader = self::ARY_EKURASHI_INFO;

        $objPHPExcel->getActiveSheet()->setCellValue('K5', Utility::dateUI($objOrder->created));
        $objPHPExcel->getActiveSheet()->setCellValue('B6', $strTantoName);
        $objPHPExcel->getActiveSheet()->setCellValue('I8', $aryHeader['address']);
        $objPHPExcel->getActiveSheet()->setCellValue('I9', $aryHeader['tel']);
        $objPHPExcel->getActiveSheet()->setCellValue('K9', $aryHeader['fax']);
        $objPHPExcel->getActiveSheet()->setCellValue('I10', $aryHeader['free']);
        $objPHPExcel->getActiveSheet()->setCellValue('I11', $aryHeader['name']);
        $intStartRow = 24;
        $intExtentRow = $intStartRow + 11;

        foreach ($aryOrderDetail as $key => $orderDetailItem) {
            if($intStartRow >= $intExtentRow) {
                //insert rows
                $intNewRow = $intStartRow + 1;
                $objPHPExcel->getActiveSheet()->insertNewRowBefore($intNewRow, 1);
                $objPHPExcel->getActiveSheet()->mergeCells("J$intNewRow:L$intNewRow");
            }
            $strTani = isset(MProductTable::TANI_VALUE[$orderDetailItem['tani']]) ? MProductTable::TANI_VALUE[$orderDetailItem['tani']] : '';
            $objPHPExcel->getActiveSheet()->setCellValue("B$intStartRow", $orderDetailItem['product_name']);
            $objPHPExcel->getActiveSheet()->setCellValue("F$intStartRow", $orderDetailItem['suuryou']);
            $objPHPExcel->getActiveSheet()->setCellValue("G$intStartRow", $strTani);
            $objPHPExcel->getActiveSheet()->setCellValue("H$intStartRow", $orderDetailItem['hatchuu_tanka']);
            $objPHPExcel->getActiveSheet()->setCellValue("I$intStartRow", $orderDetailItem['hatchuu_kingaku']);

            $intStartRow++;
        }*/

        $this->excelResponse($objPHPExcel, '発注書Ａ～Ｃ.xlsx');
    }

    private function loadExcelForm($fileName) {
        try {
            $strPath = Constant::EXCEL_TEMPLATE_PATH.$fileName;

            return \PHPExcel_IOFactory::load($strPath);
        } catch (\PHPExcel_Reader_Exception $e) {
            echo 'Load PHPExcel_IOFactory fail';die;
        }
    }

    public function importMstData() {
        $objPHPExcel = $this->loadExcelForm('supplier.xlsx');
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $data = [];
        for ($row = 2; $row <= $highestRow; $row++){
            if($row % 11 === 0) { $data = []; }
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            //  Insert row data array into your database of choice here

            $data[] = [
                'koudo' => $rowData[0][0], //仕入先ｺｰﾄﾞ
                'mei_1' => $rowData[0][1], //仕入先名１
                'mei_2' => $rowData[0][2], //仕入先名２
                'ryakushou' => $rowData[0][3], //仕入先名略称
                'sakuin' => $rowData[0][4], //仕入先名索引
                'yuubenbangou' => $rowData[0][5], //郵便番号
                'juusho_1' => $rowData[0][6], //住所１
                'juusho_2' => $rowData[0][7], //住所２
                'juusho_3' => $rowData[0][8], //住所３
                'kasutama_bakoudo' => $rowData[0][9], //カスタマバーコード
                'denwa' => $rowData[0][10], //電話番号
                'fax' => $rowData[0][11], //ＦＡＸ番号
                'm_system_shiiresaki_kategori_id' => $rowData[0][12], //カテゴリーｺｰﾄﾞ
                //'xxx' => $rowData[0][13], //カテゴリー名
                //'xxx' => $rowData[0][14], //支払先ｺｰﾄﾞ
                //'xxx' => $rowData[0][15], //支払先名
                'shiharai_saki_kubun' => $rowData[0][16], //支払先区分
                //'xxx' => $rowData[0][17], //支払先区分名
               // 'xxx' => $rowData[0][18], //カテゴリーｺｰﾄﾞ
                // '仕入先名２' => $rowData[0][19], //カテゴリー名
                'm_system_tantousha_id' => $rowData[0][20], //担当者ｺｰﾄﾞ
                //'xxx' => $rowData[0][21], //担当者名
                //'shiiretanka_settei_kubun' => $rowData[0][22], //仕入単価設定区分
                //'xxx' => $rowData[0][23], //仕入単価設定区分名
                'hidzuke_inji_kubun' => $rowData[0][24], //日付印字区分
                //'仕入先名２' => $rowData[0][25], //日付印字区分名
                'aitesaki_tantousha_mei' => $rowData[0][26], //相手先担当者名
            ];

            if($row == $highestRow or $row % 11 === 10) {
                $entities = $this->MSupplier->newEntities($data);
                $res = $this->MSupplier->saveMany($entities);
                var_dump($res);
            }
        }
        die;
    }

    public function importMstSupPrd() {
        $objPHPExcel = $this->loadExcelForm('supplier_product.xlsx');
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $data = [];
        for ($row = 2; $row <= $highestRow; $row++){
            if($row % 11 === 0) { $data = []; }
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            //  Insert row data array into your database of choice here
            //get m_supplier_id
            $supplier= $this->MSupplier->find()
                ->select(['id'])
                ->where(['koudo' => $rowData[0][4]])
                ->first();
            $data[] = [
                'tanka_masuta_kubun' => (int) $rowData[0][0], //単価ﾏｽﾀｰ区分
                //'xxx' => $rowData[0][1], //単価ﾏｽﾀｰ区分名
                'tanka_shurui' => (int) $rowData[0][2], //単価種類
                //'xxx' => $rowData[0][3], //単価種類名
                //'xxx' => $rowData[0][4], // 取引先ｺｰﾄﾞ
                //'xxx' => $rowData[0][5], // 取引先名
                //'xxx' => $rowData[0][6], //カテゴリーｺｰﾄﾞ
                //'xxx' => $rowData[0][7], //カテゴリー名
                'shouhin_koudo' => $rowData[0][8], //商品ｺｰﾄﾞ
                'shouhin_mei' => $rowData[0][9], //商品名
                'bunrui_koudo' => $rowData[0][10], //分類ｺｰﾄﾞ
                //'xxx' => $rowData[0][11], //分類名
                'tanka_shubetsu' => $rowData[0][12], //単価種別
                //'xxx' => $rowData[0][13], //単価種別名
                'tanka' => (int)$rowData[0][14], //単価
                //'xxx' => $rowData[0][15], //単価掛率
                //'xxx' => $rowData[0][16], //単価変更日付
                //'xxx' => $rowData[0][17], //変更後単価使用区分
                // 'xxx' => $rowData[0][18], //期間単価対象日付
                // '仕入先名２' => $rowData[0][19], //変更後単価
                //'m_system_tantousha_id' => $rowData[0][20], //変更後単価掛率
                'm_supplier_id' => $supplier->id
            ];

            if($row == $highestRow or $row % 11 === 10) {
                $entities = $this->MSupplierProduct->newEntities($data);
                $res = $this->MSupplierProduct->saveMany($entities);
                var_dump($res);
            }
        }
        die;
    }

    public function supPrdSql()
    {
        $res = $this->MSupplierProduct->find('all')->toArray();
        $n = 0;
        echo "INSERT INTO m_supplier_product (`m_supplier_id`,`tanka_masuta_kubun`, `tanka_shurui`, `shouhin_koudo`, 
`shouhin_mei`, `bunrui_koudo`, `tanka_shubetsu`, `tanka`, `created`, `modified`) VALUES"."</br>";
        foreach ($res as $val)
        {
            echo  "(".$val->m_supplier_id.",".$val->tanka_masuta_kubun.",".$val->tanka_shurui.",
            '".$val->shouhin_koudo."','".$val->shouhin_mei."','".$val->bunrui_koudo."',".$val->tanka_shubetsu.",".$val->tanka.",
             now(), now()),"."</br>";
            $n ++;
        }

        die;
    }

    public function importPrd() {
        $objPHPExcel = $this->loadExcelForm('product.xlsx');
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $data = [];
        $aryTani = MProductTable::TANI_VALUE;
        for ($row = 2; $row <= $highestRow; $row++){
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);

            $ary = $this->MSupplierProduct->find('all')
                ->select([
                    'id','m_supplier_id'
                ])
                ->where([
                    'deleted is' => null,
                    'shouhin_koudo' => $rowData[0][0]
                ])->toArray();

            if(empty($ary)) {
                $a = new \stdClass;
                $a->m_supplier_id = null;
                $a->id = null;
                $ary[] = $a;
            }
            foreach ($ary as $t) {
                $data[] = [
                    'koudo' =>  $rowData[0][0], //商品ｺｰﾄﾞ
                    'mei' => $rowData[0][1], //商品名
                    'mei_sakuin' => $rowData[0][2], //商品名索引
                    'tani' => array_search($rowData[0][3], $aryTani) ?: null, //単位
                    'setto_hinkubun' => $rowData[0][4], // ｾｯﾄ品区分
                    //'xxx' => $rowData[0][5], // ｾｯﾄ品区分名
                    //'xxx' => $rowData[0][6], //自動振替処理対象区分
                    //'xxx' => $rowData[0][7], //自動振替処理対象区分名
                    'zaiko_kanri_kubun' => $rowData[0][8], //在庫管理区分
                    //'xxx' => $rowData[0][9], //在庫管理区分名
                    //'xxx' => $rowData[0][10], //主仕入先ｺｰﾄﾞ
                    //'xxx' => $rowData[0][11], //主仕入先名
                    'hyoujun_uriage_tanka' => $rowData[0][12], //標準売上単価
                    'ranku_1_uriage_tanka' => $rowData[0][13], //ﾗﾝｸ１売上単価
                    'hyoujun_shiire_tanka' => $rowData[0][14], //標準仕入単価
                    'bunrui_koudo' => $rowData[0][15], //分類ｺｰﾄﾞ
                    //'xxx' => $rowData[0][16], //分類名
                    //'m_system_shiiresaki_kategori_id' => $rowData[0][17], //カテゴリーｺｰﾄﾞ
                    // 'xxx' => $rowData[0][18], //カテゴリー名
                    'hikazei_kubun' => $rowData[0][19], //非課税区分
                    //'xxx' => $rowData[0][20], //非課税区分名
                    'uriage_tanka_settei_kubun' => $rowData[0][21], //売上単価設定区分
                    //'xxx' => $rowData[0][22], //売上単価設定区分名
                    'shiiretanka_settei_kubun' => $rowData[0][23], //仕入単価設定区分
                    //'xxx' => $rowData[0][24], //仕入単価設定区分名
                    //'xxx' => $rowData[0][25], //消費税率区分
                    //'xxx' => $rowData[0][26], //旧税率
                    //'xxx' => $rowData[0][27], //新税率
                    'zeiritsu_jisshi_nengappi' => date("Y-m-d", strtotime($rowData[0][28])), //税率実施年月日
                    'ekisei_zaiko_suuryou' => $rowData[0][29], //適正在庫数量
                    'kishu_zan_suuryou' => $rowData[0][30], //期首残数量
                    'kishu_zan_kingaku' => $rowData[0][31], //期首残金額
                    'naiyou' => $rowData[0][32], //内容
                    'keika_sochi_shiteibi' => date("Y-m-d", strtotime($rowData[0][33])), //経過措置指定日
                    'm_supplier_id' => $t->m_supplier_id,
                    'm_supplier_product_id' => $t->id,
                ];
            }
            $entities = $this->MProduct->newEntities($data);
            $res = $this->MProduct->saveMany($entities);
            $data = [];
        }
    die;
    }

    public function prdSql()
    {
        $res = $this->MProduct->find('all')->toArray();
        $n = 0;
        echo "INSERT INTO m_product (`koudo`,`mei`, `mei_sakuin`, `tani`, 
`setto_hinkubun`, `zaiko_kanri_kubun`, `hyoujun_uriage_tanka`, `ranku_1_uriage_tanka`,
 `hyoujun_shiire_tanka`,`bunrui_koudo`,`hikazei_kubun`,`uriage_tanka_settei_kubun`,`shiiretanka_settei_kubun`
 ,`zeiritsu_jisshi_nengappi`,`ekisei_zaiko_suuryou`,`kishu_zan_suuryou`,`kishu_zan_kingaku`
 ,`keika_sochi_shiteibi`,`m_supplier_id`,`m_supplier_product_id`,`created`, `modified`) VALUES"."</br>";
        foreach ($res as $val)
        {
            $a = $val->m_supplier_id != '' ? $val->m_supplier_id : 'null';
            $b = $val->m_supplier_product_id  != '' ? $val->m_supplier_product_id : 'null';
            echo  "('".$val->koudo."','".$val->mei."','".$val->mei_sakuin."',
            ".$val->tani.",".$val->setto_hinkubun.",".$val->zaiko_kanri_kubun.",".$val->hyoujun_uriage_tanka.",".$val->ranku_1_uriage_tanka.",
            ".$val->hyoujun_shiire_tanka.",'".$val->bunrui_koudo."',".$val->hikazei_kubun.",".$val->uriage_tanka_settei_kubun.",".$val->shiiretanka_settei_kubun.",
            '".$val->zeiritsu_jisshi_nengappi."',".$val->ekisei_zaiko_suuryou.",".$val->kishu_zan_suuryou.",".$val->kishu_zan_kingaku.",
            '".$val->keika_sochi_shiteibi."',".$a.",".$b.",now(), now()),"."</br>";
            $n ++;
        }

        die;
    }
    /**
     * @param $objPHPExcel
     * @param $strExportName
     * @throws \PHPExcel_Writer_Exception
     */
    private function excelResponse($objPHPExcel, $strExportName) {
        try {
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$strExportName.'"');
            header('Cache-Control: max-age=0');

            $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        } catch (\PHPExcel_Reader_Exception $e) {
            echo ' PHPExcel_IOFactory::createWriter fail';
        }
        die;
    }
}
