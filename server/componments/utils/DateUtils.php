<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/15
 * Time: 20:20
 */

namespace app\componments\utils;


class DateUtils
{

    public static function get_day_startline(){
        $t=time();//获取当前时间戳

        return mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
    }

    public static function get_day_endline(){
        $t=time();//获取当前时间戳

        return mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));

    }

    public static function getYMD(){
        return date('Y-m-d',time());
    }
    //13位
    public static function getLinuxTime(){
        list($t1, $t2) = explode(' ', microtime());
        return (float)sprintf('%.0f',(floatval($t1)+floatval($t2))*1000);
    }
}