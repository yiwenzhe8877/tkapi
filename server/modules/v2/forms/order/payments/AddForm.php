<?php

namespace app\modules\v2\forms\order\payments;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $money;
	public $cur_money;
	public $order_id;
	public $member_id;
	public $status;
	public $pay_name;
	public $pay_type;
	public $t_payed;
	public $op_id;
	public $payment_bn;
	public $account;
	public $bank;
	public $pay_account;
	public $currency;
	public $paycost;
	public $pay_app_id;
	public $pay_ver;
	public $ip;
	public $ip_area;
	public $t_begin;
	public $t_confirm;
	public $memo;
	public $return_url;
	public $trade_no;
	public $disabled;
	public $thirdparty_account;
	public $username;
	


    public function addRule(){
        return [
            [["money","cur_money","order_id","member_id","status","pay_name","pay_type","t_payed","op_id","payment_bn","account","bank","pay_account","currency","paycost","pay_app_id","pay_ver","ip","ip_area","t_begin","t_confirm","memo","return_url","trade_no","disabled","thirdparty_account","username"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_payments');
        $obj->setData($form);
        return $obj->run();

    }
}