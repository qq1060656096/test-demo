<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-10-23
 * Time: 18:01
 */

namespace Common\Modules\Infrastructure\Helper;


/**
 * Class Helper
 * @package Common\Modules\Infrastructure\Helper
 */
class Helper
{
    const IS_T = 'T';
    const IS_F = 'F';

    const ZERO_DATE_Ymd = '0000-00-00';
    // AI Generated Code
    // Author: zhao si gui
    const ZERO_DATE_YmdHis = '0000-00-00 00:00:00';
    const MIN_DEFAULT_DATE_Ymd = '1970-01-01';
    const MIN_DEFAULT_DATE_YmdHis = '1970-01-01 00:00:00';

    const DATE_SHOW_MAP = [
        self::ZERO_DATE_Ymd => '',
        self::ZERO_DATE_YmdHis => '',
        self::MIN_DEFAULT_DATE_Ymd => '',
        self::MIN_DEFAULT_DATE_YmdHis => '',
    ];

    const DATE_FORMAT_YmdHis = 'Y-m-d H:i:s';
    const DATE_FORMAT_YmdHi = 'Y-m-d H:i';
    const DATE_FORMAT_Ymd = 'Y-m-d';
    const DATE_FORMAT_Ym = 'Y-m';


    const DATE_FORMAT_YmdHisStart = 'Y-m-d 00:00:00';
    const DATE_FORMAT_YmdHisEnd = 'Y-m-d 23:59:59';

    const DATE_FORMAT_YmdHiStart = 'Y-m-d H:i:00';
    const DATE_FORMAT_YmdHiEnd = 'Y-m-d H:i:59';

    const FORMAT_SYS_NUMBER = 1;
    const FORMAT_SYS_PRICE = 2;
    const FORMAT_SYS_ORDER_PRICE = 3;
    const FORMAT_INT = 4;
    const FORMAT_FLOAT = 5;
    const FORMAT_STRING = 6;

    /**
     * @param string $date_1
     * @param string $date_2
     * @param string $differenceFormat
     * @return string
     * @throws \Exception
     */
    public static function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        if (!$interval) {
            throw new \Exception("时间格式错误", 500100011);
        }
        return $interval->format($differenceFormat);
    }


    /**
     * 日期格式检测
     * @param string $dateStr
     * @param string $format 默认是 'Y-m-d H:i:s'
     * @return bool
     */
    public static function dateFormatCheck($dateStr, $format = 'Y-m-d H:i:s')
    {
        $dateStr = trim($dateStr);
        if (empty($dateStr)) {
            return false;
        }
        $time = strtotime($dateStr);
        if ($time <= 0) {
            return false;
        }
        $checkDateStr = date($format, $time);
        if (!$checkDateStr) {
            return false;
        }
        if ($checkDateStr != $dateStr) {
            return false;
        }
        return true;
    }

    /**
     * 日期检测
     * @param string $dateStr
     * @return bool
     */
    public static function dateFormatCheckSimple($dateStr)
    {
        if (!Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_Ymd) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_YmdHi) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_YmdHis) && !Helper::dateFormatCheck($dateStr, Helper::DATE_FORMAT_Ym)) {
            return false;
        }
        return true;
    }

    /**
     * 自动检查日期格式， 成功返回日期格式，失败返回false
     *
     * @param string $date
     * @return false|string
     */
    public static function autoCheckDateFormat($date) {
        if (self::dateFormatCheck($date, self::DATE_FORMAT_Ymd)) {
            return self::DATE_FORMAT_Ymd;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_YmdHi)) {
            return self::DATE_FORMAT_YmdHi;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_YmdHis)) {
            return self::DATE_FORMAT_YmdHis;
        }
        if (self::dateFormatCheck($date, self::DATE_FORMAT_Ym)) {
            return self::DATE_FORMAT_Ym;
        }
        return false;
    }


}