<?php

namespace app\models\tkuser;


use app\componments\sql\SqlGet;

class Base extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_base';
    }
    //获得运营商的手机
    public static function getSuperPhone($phone){
        $flag=true;
        while ($flag){
            $user=Base::find()->where(['=','phone',$phone])->one();

            if($user->group_id==3){
                return $user->phone;
                break;
            }

            $phone=$user->p_phone;

        }
    }

    //获得用户手机
    public static function getUserPhone(){
        $request=\Yii::$app->getRequest();
        $accessToken=$request->headers[\Yii::$app->params['token']];

        if(!$accessToken)
            $accessToken = $request->get(\Yii::$app->params['token']);

        $user=Base::find()->where(['=','auth_key',$accessToken])->one();
        return $user->phone;

    }

    public static function getUserOpenid(){
        $request=\Yii::$app->getRequest();
        $accessToken=$request->headers[\Yii::$app->params['token']];

        if(!$accessToken)
            $accessToken = $request->get(\Yii::$app->params['token']);

        $user=Base::find()->where(['=','auth_key',$accessToken])->one();
        return $user->phone;
    }


    //获得上下级关系
    public static function getTeamlist($type,$pageNum){
        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_base');
        $obj->setOrderBy('id desc');
        $arr=[];
        //直属
        if($type==1){
            $arr['p_phone=']=$phone;
        }
        //团队
        if($type==2){
            $arr['s_phone=']=$phone;
        }
        $obj->setFields('phone,jointime,group_name,headingimgurl');
        $obj->setWhere($arr);
        $obj->setPageNum($pageNum);
        return $obj->get_list();

    }

}