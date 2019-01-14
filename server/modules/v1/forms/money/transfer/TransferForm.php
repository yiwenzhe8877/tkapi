<?php

namespace app\modules\v1\forms\money\transfer;



use app\componments\common\CommonForm;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlGet;
use app\componments\sql\SqlUpdate;
use app\componments\zfbtransfer\Alipay;
use app\models\tkpay\Transferlog;
use app\models\tkuser\Base;
use app\models\tkuser\WithdrawLog;
use yii\debug\models\search\Log;

class TransferForm extends CommonForm
{



    public function run($form){



        $user=WithdrawLog::find()->where(['=','status','0'])
            ->orderBy('dateline asc')
            ->one();


       // p($user);
        if(!$user){
            return "没人提现";
        }
        $biz_no=date('ymdhis');


        $zhifubao=$user->zhifubao;
        $withdraw_id=$user->id;

        $trans_log=Transferlog::find()
            ->where(['=','withdraw_id',$withdraw_id])
            ->andWhere(['=','touser',$zhifubao])
            ->one();
        if($trans_log){
            return "提现id:". $withdraw_id.".支付宝账户:".$zhifubao."已经转过了";
        }



        $db = \Yii::$app->db;
        $transaction = $db->beginTransaction();  //开启事务
        try {

            $cover=[
                'touser'=>$user->zhifubao,
                'tousername'=>$user->zhifubao_name,
                'dateline'=>time(),
                'withdraw_id'=>$withdraw_id,
                'phone'=>$user->phone,
                'money'=>$user->money,
                'biz_no'=>$biz_no,
                'status'=>1,
            ];
            //转账日志
            $obj=new SqlCreate();
            $obj->setTableName('tkpay_transferlog');
            $obj->setCoverData($cover);
            $ret= $obj->run();
            if($ret!=true){
                $transaction->rollBack();
                return;
            }

            //提现日志
            $obj=new SqlUpdate();
            $obj->setTableName('tkuser_withdrawlog');
            $obj->setData(['status'=>1,'remark'=>"转账成功"]);
            $obj->setWhere(['id='=>$user->id]);
            $ret=$obj->run();
            //0表示没变化，1表示变化了
            if($ret==0){
                $transaction->rollBack();
                return;
            }

            //转账
            $obj=new Alipay();
            $data = [
                'payee_account'  => $user->zhifubao, //收款方账户
                'amount'  => round($user->money,2) , //金额
                'biz_no'=>$biz_no
            ];


            $ret=$obj->transfer($data);
            \Yii::error(json_decode($ret));
            return;
            $resp=json_decode($ret,true)->alipay_fund_trans_toaccount_transfer_response;
            $code=$resp->code;

            if($code!='10000'){
                $remark=$resp->sub_msg;
            }
            else{
                $remark=$resp->order_id;
            }


            $obj=new SqlUpdate();
            $obj->setTableName('tkpay_transferlog');
            $obj->setData(['remark'=>$remark]);
            $obj->setWhere(['biz_no='=>$biz_no]);
            $ret=$obj->run();


            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
        }

        return $ret;

    }


}