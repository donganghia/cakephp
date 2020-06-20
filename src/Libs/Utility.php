<?php
/* Copyright (c) ASC All Rights Reserved.
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * ［変更履歴］
 * 2018.11.28 Hieunld：新規作成
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
namespace App\Libs;

use Cake\Filesystem\Folder;
use Cake\Cache\Cache;

class Utility
{

    public static function createDate($strFormat, $strDate = '')
    {
        if ($strDate) {
            return date($strFormat, strtotime($strDate));
        }

        return date($strFormat);
    }

    public static function dbDate() {
        return self::createDate(Constant::YMD_HIS_DB);
    }

    public static function createFolder($path) {
        if (!file_exists($path)) {
            $old = umask(0);
            mkdir($path , 0755, true);
            umask($old);
        }
    }

    public static function fileName($ext) {
        $format = '%s_%s.%s';

        return sprintf($format, time(), uniqid(), $ext);
    }

    /**
     * @param $target
     */
    public static function deleteFiles($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned

            foreach( $files as $file ) {
                self::deleteFiles( $file );
            }

            rmdir( $target );
        } elseif(is_file($target)) {
            unlink( $target );
        }
    }

    public static function formatBytes($bytes, $precision = 1) {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$precision}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

    public static function validMsg($msg, $aryParam = []) {
        $cntParam = count($aryParam);
        switch ($cntParam) {
            case 1:
                $result = sprintf(__($msg), __($aryParam[0]));
                break;
            case 2:
                $result = sprintf(__($msg), __($aryParam[0]), __($aryParam[1]));
                break;
            case 3:
                $result = sprintf(__($msg), __($aryParam[0]), __($aryParam[1]), __($aryParam[2]));
                break;
            case 4:
                $result = sprintf(__($msg), __($aryParam[0]), __($aryParam[1]), __($aryParam[2]), __($aryParam[4]));
                break;
            default:
                $result = __($msg);
        }

        return $result;
    }

    /**
     * @param $value
     * @return false|string
     */
    public static function dateFull($value)
    {
        return $value ? date_format($value, 'Y/m/d H:i:s') : '';
    }

    /**
     * @param  mixed $value
     *
     * @return false|string
     */
    public static function dateShort($value)
    {
        return $value ? date_format($value, Constant::YMD) : '';
    }

    /**
     * @param $value
     * @return false|string
     */
    public static function dateUI($value)
    {
        return $value ? date_format($value, Constant::YMD_JA) : '';
    }

    /**
     * @return string
     */
    public static function genToken() {
        return sprintf('%s_%s', time(), uniqid());
    }

    /**
     * @return string
     */
    public static function genProjectCode($num) {
        $strFormat = '%s';
        return sprintf($strFormat, str_pad($num, 5, '0', STR_PAD_LEFT));
    }

    /**
     * @return string
     */
    public static function genOrderCode($num) {
        $strFormat = '%s';
        return sprintf($strFormat, str_pad($num, 3, '0', STR_PAD_LEFT));
    }

    public static function csvName($name) {
        $format = '%s_%s.csv';
        return sprintf($format, $name, date('Ymd'));
    }
}