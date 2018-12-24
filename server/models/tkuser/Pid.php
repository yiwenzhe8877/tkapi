<?php

namespace app\models\tkuser;


class Pid extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_pid';
    }

    public static function getPid(){
        $user=Base::find()->where(['=','auth_key',self::getToken()])->one();

        $phone= $user->phone;
        $pid=Pid::find()->where(['=','phone',$phone])->one();
        return $pid->pid;

    }

    public static function getToken(){
        $request=\Yii::$app->getRequest();
        $accessToken=$request->headers[\Yii::$app->params['token']];

        if(!$accessToken)
            $accessToken = $request->get(\Yii::$app->params['token']);
        return $accessToken;
    }
}