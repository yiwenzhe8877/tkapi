<?php

namespace app\models\tkuser;


use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;

class Verifycode extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_verifycode';
    }
    //是否满足发送条件
    public static function can_send($phone){

        date_default_timezone_set('PRC');


        $today = strtotime(date("Y-m-d"),time());
        $end = $today+60*60*24;

        $model=Verifycode::find()
            ->andWhere(['>','dateline',$today])
            ->andWhere(['<','dateline',$end])
            ->count();

        if($model>5){
             ApiException::run("同一个手机号,一天只能接收5条短信");
        }
    }

    //验证短信
    public static function verify_code_yf($phone,$code,$type){

        date_default_timezone_set('PRC');


        $model=Verifycode::find()
            ->andWhere(['>','expire',time()])
            ->andWhere(['<','dateline',time()])
            ->andWhere(['=','phone',$phone])
            ->andWhere(['=','code',$code]);


        $count=$model->count();
        if($count==0){
            ApiException::run("短信验证码错误");
        }

        $model=Verifycode::find()
            ->andWhere(['>','dateline',time()])
            ->andWhere(['<','dateline',time()+600])
            ->andWhere(['=','phone',$phone])
            ->andWhere(['=','code',$code])
            ->andWhere(['=','type',$type])
            ->andWhere(['=','is_used',1])
            ->count();
        if($model>0){
            ApiException::run("短信验证码已经使用过了");
        }


        $obj=new SqlUpdate();
        $obj->setTableName('tkuser_verifycode');
        $obj->setData(['is_used'=>1]);
        $obj->setWhere(['phone='=>$phone,' and code='=>$code]);
        $obj->run();

    }
}