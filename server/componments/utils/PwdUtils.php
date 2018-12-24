<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/24
 * Time: 15:30
 */

namespace app\componments\utils;


class PwdUtils
{
    public static function encryptLoginPwd($v){
        return md5($v.\Yii::$app->params['salt']);
    }

    public static function isStrong($v){
        if(strlen($v) < 6 || strlen($v) > 20){
            return "密码必须大于6位且小于20位";
        }
        return true;
    }
}