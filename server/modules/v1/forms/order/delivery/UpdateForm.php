<?php

namespace app\modules\v1\forms\order\delivery;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $delivery_id;
	public $order_id;
	public $store_id;
	public $delivery_bn;
	public $money;
	public $logi_id;
	public $logi_name;
	public $logi_no;
	public $op_name;
	public $op_id;
	public $status;
	public $memo;
	public $disabled;
	public $dateline;
	public $lastupdate;
	public $member_id;
	public $ship_name;
	public $ship_area;
	public $ship_addr;
	public $ship_zip;
	public $ship_tel;
	public $ship_mobile;
	public $ship_email;
	public $dlycorp;
	


    public function addRule(){
       return [
           [["delivery_id","order_id","store_id","delivery_bn","money","logi_id","logi_name","logi_no","op_name","op_id","status","memo","disabled","dateline","lastupdate","member_id","ship_name","ship_area","ship_addr","ship_zip","ship_tel","ship_mobile","ship_email","dlycorp"],'required','message'=>'{attribute}不能为空'],
           [['delivery_id'], 'exist','targetClass' => 'app\models\order\delivery', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_delivery');
        $obj->setData($form);
        $obj->setWhere(['delivery_id='=>$form->delivery_id]);
        return $obj->run();

    }
}