<?php

namespace App\Helper;

use Carbon\Carbon;

class Field
{
    public static function getThaiDate($strDate)
    {
        $strMonthThai   = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

        if(empty($strDate)){
            return " - ";
        }

        $date           = Carbon::createFromFormat('Y-m-d' , $strDate);

        if(empty($date)){
            return "format invalid";
        }

        $strYear        = $date->year;
        $strMonth       = $date->month;
        $strDay         = $date->day;
        $strMonthThai   = $strMonthThai[$strMonth];

        return "$strDay $strMonthThai $strYear";
    }

    public static function getLevelLabel($level)
    {
        switch ($level) {
            case 1:
                return 'น้อยมาก';
            case 2:
                return 'น้อย';
            case 3:
                return 'มาก';
            case 4:
                return 'มากที่สุด';
            default:
                return $level;
        }
    }

    public static function getHasLabel($level)
    {
        switch ($level) {
            case 1:
                return 'เคย';
            case 0:
                return 'ไม่เคย';
            default:
                return $level;
        }
    }

    public static function value($val,$default='')
    {
        if(!empty($val)){
            return $val;
        }
        return $default;
    }
}