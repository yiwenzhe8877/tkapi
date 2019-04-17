<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/4
 * Time: 9:09
 */

namespace app\componments\utils;


class CommonUtils
{
    public static function hidephone($v){
        $head=substr($v,0,3);
        $tail=substr($v,7,4);
        return $head."****".$tail;
    }
}