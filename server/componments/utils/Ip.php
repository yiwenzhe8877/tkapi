<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/15
 * Time: 19:48
 */

namespace app\componments\utils;


class Ip
{
    public static function get_real_ip(){
        //判断服务器是否允许$_SERVER
        if(isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }elseif(isset($_SERVER["HTTP_CLIENT_IP"])) {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            }else{
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        }else{
            //不允许就使用getenv获取
            if(getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            }elseif(getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            }else{
                $realip = getenv("REMOTE_ADDR");
            }
        }

        return $realip;

    }


    public static  function  get_position(){
        $ip=self::get_real_ip();
        $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip=' . $ip);

        if(empty($res))

        {

            return false;

        }

        $jsonMatches = array();

        preg_match('#\{.+?\}#', $res, $jsonMatches);

        if(!isset($jsonMatches[0]))

        {

            return false;

        }

        $json = json_decode($jsonMatches[0], true);

        if(isset($json['ret']) && $json['ret'] == 1)

        {

            $json['ip'] = $ip;

            unset($json['ret']);

        }else{

            return false;

        }

        return $json;
    }
}