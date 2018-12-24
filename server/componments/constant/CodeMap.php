<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 20:33
 */
namespace app\componments\constant;

class CodeMap
{

    private static $map=[
        '300002'=>'手机号码错误',

        '900001'=>'系统错误',
    ];
    public static function get_code($code){
       ;
        if(!in_array($code, array_flip (  self::$map )))
            return "";

        return self::$map[$code];
    }
}