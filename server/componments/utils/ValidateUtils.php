<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/14
 * Time: 20:56
 */

namespace app\componments\utils;


class ValidateUtils
{
    public static function run_phone($v){
       return preg_match('/^1[34578]\d{9}$/',$v)==0?false:true;
    }

    public static function verify_code($v){
        return preg_match('/^[0-9]{6}$/',$v)==0?false:true;
    }

}