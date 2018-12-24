<?php

namespace app\modules\v2\forms\order\refunds;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $refund_id;
	public $order_id;
	public $member_id;
	public $logi_id;
	public $logi_name;
	public $logi_no;
	public $ship_name;
	public $ship_area;
	public $ship_addr;
	public $ship_zip;
	public $ship_tel;
	public $ship_mobile;
	public $ship_email;
	public $op_id;
	public $status;
	public $order_item_id;
	public $ip;
	public $ip_area;
	public $disabled;
	public $username;
	public $refunds_type;
	public $dateline;
	public $refunds_money;
	public $op_name;
	public $op_time;
	public $ship_province;
	public $ship_city;
	public $ship_dist;
	public $ship_community;
	public $finance_bank;
	public $finance_account;
	public $finance_trade_no;
	public $finance_money;
	public $finance_remark;
	public $finance_point;
	public $refunds_point;
	


    public function addRule(){
       return [
           [["refund_id","order_id","member_id","logi_id","logi_name","logi_no","ship_name","ship_area","ship_addr","ship_zip","ship_tel","ship_mobile","ship_email","op_id","status","order_item_id","ip","ip_area","disabled","username","refunds_type","dateline","refunds_money","op_name","op_time","ship_province","ship_city","ship_dist","ship_community","finance_bank","finance_account","finance_trade_no","finance_money","finance_remark","finance_point","refunds_point"],'required','message'=>'{attribute}不能为空'],
           [['refund_id'], 'exist','targetClass' => 'app\models\order\refunds', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_refunds');
        $obj->setData($form);
        $obj->setWhere(['refund_id='=>$form->refund_id]);
        return $obj->run();

    }
}