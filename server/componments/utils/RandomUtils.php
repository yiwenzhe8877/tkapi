<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 20:39
 */

namespace app\componments\utils;


class RandomUtils
{
    public static function get_random_num($length){
        $result='';
        for($i=0;$i<$length;$i++){
            $result.=mt_rand(0, 9);
        }
        return $result;
    }

    public static function get_random_nummixenglish($length){
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyz 
               ABCDEFGHIJKLOMNOPQRSTUVWXYZ';
        $key='';
        for($i=0;$i<$length;$i++)
        {
            $key .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return $key;
    }
}