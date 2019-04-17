<?php
/**
 * Created by PhpStorm.
 * adminUser: idz025
 * DateUtils: 2018/11/5
 * Time: 13:27
 */

namespace app\componments\utils;



class Filter
{
    public static $sqlinject_map=["delete","script","--","document","javascript","-","$", "(", ")", "%", "@","!"];

    public static function sqlinject($value){

        foreach (self::$sqlinject_map as $k=>$v){
            if($v===$value){
             //   ApiException::run('参数包含非法字符'.$v,'10010007',__CLASS__,__METHOD__,__LINE__);
            }
        }
        return $value;
    }
}