<?php

namespace app\models\tkuser;


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
}