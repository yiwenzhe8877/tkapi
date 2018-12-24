<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 17:44
 */
namespace app\models\api\admin\user;

use app\componments\auth\QueryParamAuthBackEnd;
use app\models\admin\user;

class GetLoginedAdminUserApi
{
    //取消所有的默认
    public static function getUid(){
     return   user::findOne(['auth_key'=>self::getAdminToken()])->user_id;
    }
    public static function getName(){
        return   user::findOne(['auth_key'=>self::getAdminToken()])->username;
    }

    public static function getGroupId(){
        return   user::findOne(['auth_key'=>self::getAdminToken()])->group_id;

    }
    public static function getAllInfo(){
        return   user::findOne(['auth_key'=>self::getAdminToken()]);
    }

    public static function getAdminToken(){
        $request=\Yii::$app->getRequest();

        $accessToken=$request->headers[\Yii::$app->params['admin_token']];

        if(!$accessToken){
            $accessToken = $request->get(\Yii::$app->params['admin_token']);
        }
        return $accessToken;
    }
}