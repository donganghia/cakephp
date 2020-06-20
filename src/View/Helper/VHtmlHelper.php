<?php
namespace App\View\Helper;

use App\Libs\Constant;
use App\Libs\Utility;
use Cake\View\Helper\HtmlHelper;

class VHtmlHelper extends HtmlHelper
{

    public function dateYMD($value)
    {
        return $value ? date_format($value, Constant::YMD) : '';
    }

    public function dateJa($value)
    {
        return $value ? date_format($value, Constant::YMD_JA) : '';
    }

    public function dateFull($value)
    {
        return Utility::dateFull($value);
    }

    public function dateToYYYYMMDD($value)
    {
        return $value ? date("Y/m/d", strtotime($value)) : '';
    }

    public function dateToYMDhi($value)
    {
        return $value ? date('Y/m/d H:i', strtotime($value)) : '';
    }

    public function dateToYMDhis($value)
    {
        return $value ? date('Y/m/d H:i:s', strtotime($value)) : '';
    }

    public function toDayYYYYMMDD()
    {
        return Utility::createDate('Y/m/d');
    }

    public function selectNull($value)
    {
        return Constant::SELECT_EMPTY + $value;
    }

    public function selectAll($value)
    {
        return Constant::SELECT_ALL + $value;
    }

    public function convertToSearchString($ary)
    {
        $str = "";
        if(!empty($ary)) {
            foreach ($ary as $k => $v) {
                $str .= $k."=".$v."&";
            }
        }
        return $str !== "" ? substr($str, 0, -1) : "";
    }

    public function convertNumberToMoney($value)
    {
        if(mb_strlen($value) > 0) {
            return '￥'.number_format($value);
        } else {
            return '';
        }
    }

    public function hideNumberToMoney($value)
    {
        $value = self::convertNumberToMoney($value);
        return str_replace([0,1,2,3,4,5,6,7,8,9], '*', $value);

    }

    public function getBackAction($screen)
    {
        switch ($screen){
            case 'yoteiTouroku':
            case 'kakuteiTouroku':
                $back = '../menu/juchuu-touroku';
                break;
            case 'yoteiHenshuu':
                $back = '../yotei-ichiran';
                break;
            case 'kakuteiHenshuu':
                $back = '../juchuu-sumi-ichiran';
                break;
            case 'kanryouKeijouShori': 
                $back = '../kanryou-keijou-shori-ichiran';
                break;
            case 'ankenHenshuu':
                $back = '../anken-kensaku';
                break;
            case 'kizonHenshuu':
                $back = '../yotei-henshuu';
                break;
            case 'copy':
                $back = '../kakutei-touroku';
                break;
            case 'shinkiDenpyou':
                $back = '../yotei-henshuu/'.$this->request->getParam('pass')[0];
                break;
            default:
                $back = $this->request->referer();
                break;
        }
        return $back;
    }

    public function requiredSelect($value)
    {
        return Constant::REQUIRED_SELECT + $value;
    }

    public function frameStatus($value)
    {
        return '<label class="arrow_box">'.$value.'</label>';
    }
}