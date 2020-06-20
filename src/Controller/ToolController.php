<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Controller;

use App\Libs\Constant;
use App\Libs\Utility;
use Cake\Cache\Cache;
use Dompdf\Dompdf;
use Mpdf\Mpdf;

class ToolController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index', 'clearCache', 'excelExport', 'uiSample']);
    }

    public function index()
    {

    }

    public function uiSample()
    {

    }

    public function clearCache()
    {
        $this->autoRender = false;

        Cache::clear();
        Cache::clearAll();

        $target = CACHE;
        $lsDir = glob( $target . '*', GLOB_MARK);
        $aryDir = $aryFile = [];
        foreach ($lsDir as $dirItem) {
            if (is_file($dirItem))
                $aryFile[] = $dirItem;
            if(is_dir($dirItem))
                $aryDir[] = $dirItem;
                $aryFile = array_merge($aryFile, glob( $dirItem . '*', GLOB_MARK));
        }

        var_dump($aryFile);
        foreach ($aryFile as $f) {
            if (is_file($f))
                unlink($f);
        }

        var_dump($aryDir);
        foreach ($aryDir as $dir) {
            if (is_dir($dir))
                rmdir($dir);
        }
    }

    /*public function excelExport() {
        $excelPath = Constant::EXCEL_TEMPLATE_PATH.'mitsumori.xlsx';

        $objPHPExcel = \PHPExcel_IOFactory::load($excelPath);

        $aryHeader = [
            'address' => '〒464-0075　愛知県名古屋市千種区内山3丁目30番9号'
            ,'tel' => 'TEL　052-744-0271'
            ,'fax' => 'FAX　052-744-0274'
            ,'free' => 'フリーダイヤル　0120-667-539'
            ,'name' => '代表取締役　　大谷　真哉'
        ];

        $objPHPExcel->getActiveSheet()->setCellValue('I8', $aryHeader['address']);
        $objPHPExcel->getActiveSheet()->setCellValue('I9', $aryHeader['tel']);
        $objPHPExcel->getActiveSheet()->setCellValue('K9', $aryHeader['fax']);
        $objPHPExcel->getActiveSheet()->setCellValue('I10', $aryHeader['free']);
        $objPHPExcel->getActiveSheet()->setCellValue('I11', $aryHeader['name']);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="見積書.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        die;
    }*/

    public function excelExport()
    {
        $this->autoRender = false;

        $excelPath = Constant::EXCEL_TEMPLATE_PATH . 'hatchuusho.xlsx';

        $objPHPExcel = \PHPExcel_IOFactory::load($excelPath);
        $sheet = $objPHPExcel->getActiveSheet();
        $aryHeader = [
            'address' => '〒464-0075　愛知県名古屋市千種区内山3丁目30番9号'
            , 'tel' => 'TEL　052-744-0271'
            , 'fax' => 'FAX　052-744-0274'
            , 'free' => 'フリーダイヤル　0120-667-539'
            , 'name' => '代表取締役　　大谷　真哉'
        ];
//        $sheet()->getFont()->setName('ＭＳ 明朝');
        $sheet->setCellValue('I8', $aryHeader['address']);
        $sheet->setCellValue('I9', $aryHeader['tel']);
        $sheet->setCellValue('K9', $aryHeader['fax']);
        $sheet->setCellValue('I10', $aryHeader['free']);
        $sheet->setCellValue('I11', $aryHeader['name']);


        $rendererLibrary = 'mPDF5.4';
        $rendererLibrary = 'mPDF';
        $rendererLibraryPath = '/php/libraries/PDF/' . $rendererLibrary;
        $rendererLibraryPath = ROOT.DS.'vendor'.DS.'mpdf'.DS.'mpdf';
        $rendererLibraryPath = ROOT.DS.'vendor'.DS.'dompdf'.DS.'dompdf';
        $rendererLibraryPath = ROOT.DS.'vendor'.DS.'tecnickcom'.DS.'tcpdf';
        $rendererLibraryPath = ROOT.DS.'vendor'.DS.'tecnickcom'.DS.'tcpdf';

        // DomPDF
        \PHPExcel_Settings::setPdfRenderer(
            \PHPExcel_Settings::PDF_RENDERER_TCPDF, $rendererLibraryPath
//            \PHPExcel_Settings::PDF_RENDERER_DOMPDF, $rendererLibraryPath
        );
//        $excelWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

        $writer = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'pdf');
        $writer->setPreCalculateFormulas(true);
        $writer->save(Constant::EXCEL_TEMPLATE_PATH ."featuredemo-1.pdf");

//        $excelWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'html');
//        $excelWriter->save(Constant::EXCEL_TEMPLATE_PATH . '1-html.html');

//        $objWriter = new \PHPExcel_Writer_HTML($objPHPExcel);
//        $objWriter->save(Constant::EXCEL_TEMPLATE_PATH . "05featuredemo.html");


//        $html = $objWriter->generateHTMLHeader(true);
//        $html .= $objWriter->generateSheetData();
//        $html .= $objWriter->generateSheetData();
//        $html .= $objWriter->generateHTMLFooter();
//
//        die;


        /*if (!\PHPExcel_Settings::setPdfRenderer(
            \PHPExcel_Settings::PDF_RENDERER_TCPDF,
            $rendererLibraryPath
        )) {
            die(
                'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
                'at the top of this script as appropriate for your directory structure'
            );
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment;filename="見積書.pdf"');
        header('Cache-Control: max-age=0');
        $pdfWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
//        $pdfWriter->save(Constant::EXCEL_TEMPLATE_PATH . '13-Dompdf.pdf');
        $pdfWriter->save('php://output');*/

/*

// DomPDF
PHPExcel_Settings::setPdfRenderer(
    PHPExcel_Settings::PDF_RENDERER_DOMPDF,
    __DIR__ .'/vendor/dompdf/dompdf'
);
$pdfWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
$pdfWriter->save(Constant::EXCEL_TEMPLATE_PATH . '13-Dompdf.pdf');


 * */

        // DomPDF
//        \PHPExcel_Settings::setPdfRenderer(
//            \PHPExcel_Settings::PDF_RENDERER_MPDF,
////            ROOT . DS . 'vendor' . DS .'mpdf/mpdf'
//            ROOT . DS . 'vendor' . DS .'phpoffice/phpexcel/Classes/PHPExcel/Writer/PDF/mPDF'
//        );

//        $pdfWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');
//        $pdfWriter->save(Constant::EXCEL_TEMPLATE_PATH . '13-Dompdf.pdf');

//        $pdf = new DOMPDF();
//        $pdf->set_paper(strtolower(1), $objPHPExcel);
//        $pdf->render();





//        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel);
//        $objWriter->save('php://output');
//        die;
    }
}
