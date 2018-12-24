<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 12:05
 */

namespace app\componments\utils;


class PwdEncryptUtils
{

    public static function encryptLoginPwd($v){
        return md5($v.\Yii::$app->params['salt']);

    }
}