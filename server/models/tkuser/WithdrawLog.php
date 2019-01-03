<?php

namespace app\models\tkuser;


use app\componments\sql\SqlCreate;
use app\componments\sql\SqlGet;
use app\componments\sql\SqlUpdate;
use yii\db\Exception;

class WithdrawLog extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_withdrawlog';
    }

    //提现接口
    public static function withdrawApi($openid,$phone,$source,$money){
        if($source=='app'){
            $user=Base::find()->where(['=','phone',$phone])->one();
            $withdrawlog=WithdrawLog::find()
                ->andWhere(['=','phone',$phone])
                ->andWhere(['=','status',0])
                ->one();
//            p($withdrawlog);
//
//            echo $withdrawlog->createCommand()->getRawSql();
        }

        if($source=='gzh'){
            $user=Base::find()->where(['=','openid',$openid])->one();
            $withdrawlog=WithdrawLog::find()
                ->where(['=','openid',$openid])
                ->andWhere(['=','status',0])
                ->one();
        }

        if(!$user){
            return ['code'=>'900000','msg'=>'用户信息不存在'];
        }


        if($withdrawlog){

            $time = $withdrawlog->dateline;
            //p($time);
            $time = date('Y-m-d H:i:s', $time);


            $contentStr = "您在" . $time . "提交的提现记录尚未处理,如有问题,请联系您的客服";
            return ['code'=>'900000','msg'=>$contentStr];
        }

        if(empty($money)){
            return ['code'=>'900000','msg'=>"提现金额为空"];
        }

        if (!is_numeric($money)) {
            return ["code" => "900000", "msg" => "提现金额必须是数字"];
        }

        if ((float)$money <= 0) {
            return ['code' => '10061', 'msg' => "提现金额必须是正数"];
        }

        $remainmoney = $user->remainmoney;
        if ($remainmoney < $money) {
            return ["code" => "10002", "msg" => "提现金额不能大于用户的可提现总额"];
        }

        $zhifubao = $user->zhifubao;
        $zhifubao_name = $user->zhifubao_name;

        if (empty($zhifubao) || empty($zhifubao_name)) {
            return ["code" => "10025", "msg" => "请先设置支付宝"];
        }

        if ((float)$money <= 10) {
            return ["code" => "10011", "msg" => "提现最小金额为10元"];
        }


        $contentStr = "提现成功,因提现人数过多,客服会在提现周的周五往您的支付宝账号打款,若提现周的周六周日没有收到,请联系客服";

        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();  //开启事务
        try {
            $cover=[
                'openid'=>$openid,
                'phone'=>$phone,
                'zhifubao'=>$user->zhifubao,
                'zhifubao_name'=>$user->zhifubao_name,
                'dateline'=>time(),
                'money'=>$money,
                'source'=>$source,
                'status'=>0,
                'remark'=>$contentStr,
            ];
            //新增
            $obj=new SqlCreate();
            $obj->setTableName('tkuser_withdrawlog');
            $obj->setCoverData($cover);
            $ret= $obj->run();
            if($ret!=true){
                $transaction->rollBack();
                return;
            }

            $now_money=$user->remainmoney;

            if($source=='app'){
                $obj=new SqlUpdate();
                $obj->setTableName('tkuser_base');
                $obj->setData(['remainmoney'=>($now_money-$money),'now_withdraw_money'=>$money]);
                $obj->setWhere(['phone='=>$phone]);
                $ret=$obj->run();
                //0表示没变化，1表示变化了
                if($ret==0){
                    $transaction->rollBack();
                    return;
                }
            }
            if($source=='gzh'){
                $obj=new SqlUpdate();
                $obj->setTableName('tkuser_base');
                $obj->setData(['remainmoney'=>($now_money-$money),'now_withdraw_money'=>$money]);
                $obj->setWhere(['openid='=>$openid]);
                $ret=$obj->run();
                //0表示没变化，1表示变化了
                if($ret==0){
                    $transaction->rollBack();
                    return;
                }
            }




            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }



        return ['code'=>'0','msg'=>$contentStr];


    }


}