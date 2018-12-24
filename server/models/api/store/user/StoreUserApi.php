<?php


namespace app\models\api\store\user;


use app\componments\utils\Assert;
use app\models\store\store;
use app\models\store\user;


class StoreUserApi
{
    public static function getLoginedUid(){
        return   user::findOne(['auth_key'=>self::getShopToken()])->user_id;
    }

    public static function getLoginedStoreId(){
        $store_id  = user::findOne(['auth_key'=>self::getShopToken()])->store_id;
        $store=store::find()
            ->andWhere(['=','store_id',$store_id])
            ->one();
        return $store->store_id;
    }


    public static function getShopToken(){
        $request=\Yii::$app->getRequest();

        $accessToken=$request->headers[\Yii::$app->params['middle_token']];

        if(!$accessToken){
            $accessToken = $request->get(\Yii::$app->params['middle_token']);
        }
        return $accessToken;
    }
}