<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/22
 * Time: 9:03
 */

namespace app\models\api\member\baseinfo;


use app\componments\utils\Assert;
use app\componments\utils\PwdEncryptUtils;
use app\models\member\baseinfo;

class MemberBaseinfoApi
{
    public static function changePwd($member_id,$password,$password_again){

        Assert::PasswordNotEqual($password,$password_again);
     //   Assert::PwdNotStrong($this->getPassword());

        \Yii::error($password);
        baseinfo::updateAll([
            'password'=>PwdEncryptUtils::encryptLoginPwd($password)
        ],['member_id'=>$member_id]);
        return "";
    }

    //取消所有的默认
    public static function getUid(){
        return   baseinfo::findOne(['auth_key'=>self::getAdminToken()])->member_id;
    }
    public static function getName(){
       // return   baseinfo::findOne(['auth_key'=>self::getAdminToken()])->username;
    }

    public static function getGroupId(){
        //return   baseinfo::findOne(['auth_key'=>self::getAdminToken()])->group_id;

    }
    public static function getAllInfo(){
       // return   baseinfo::findOne(['auth_key'=>self::getAdminToken()]);
    }
    public static function getAdminToken(){
        $request=\Yii::$app->getRequest();

        $accessToken=$request->headers[\Yii::$app->params['member_token']];

        if(!$accessToken){
            $accessToken = $request->get(\Yii::$app->params['member_token']);
        }
        return $accessToken;
    }
}