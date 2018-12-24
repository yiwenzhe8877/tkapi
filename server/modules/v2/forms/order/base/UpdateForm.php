<?php

namespace app\modules\v2\forms\order\base;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $order_id;
	public $store_id;
	public $store_name;
	public $store_member_id;
	public $status;
	public $total_amount;
	public $final_amount;
	public $pay_status;
	public $pay_type;
	public $ship_status;
	public $is_evaluat;
	public $is_delivery;
	public $createtime;
	public $last_modified;
	public $payment;
	public $shipping_id;
	public $shipping;
	public $member_id;
	public $ship_area;
	public $ship_name;
	public $weight;
	public $itemnum;
	public $ip;
	public $ip_area;
	public $ship_zip;
	public $ship_tel;
	public $ship_email;
	public $ship_time;
	public $ship_mobile;
	public $tax_type;
	public $tax_content;
	public $cost_tax;
	public $tax_company;
	public $is_protect;
	public $cost_protect;
	public $cost_payment;
	public $currency;
	public $cur_rate;
	public $score_u;
	public $score_g;
	public $discount;
	public $pmt_goods;
	public $pmt_order;
	public $payed;
	public $memo;
	public $disabled;
	public $mark_text;
	public $cost_freight;
	public $order_refer;
	public $addon;
	public $source;
	public $confim_day;
	public $username;
	public $paytime;
	public $shiptime;
	public $evaluattime;
	public $refund_status;
	public $experience;
	public $volume;
	public $ship_area_china;
	public $province;
	public $city;
	public $dist;
	public $community;
	public $is_start;
	public $last_modifier;
	public $display;
	


    public function addRule(){
       return [
           [["order_id","store_id","store_name","store_member_id","status","total_amount","final_amount","pay_status","pay_type","ship_status","is_evaluat","is_delivery","createtime","last_modified","payment","shipping_id","shipping","member_id","ship_area","ship_name","weight","itemnum","ip","ip_area","ship_zip","ship_tel","ship_email","ship_time","ship_mobile","tax_type","tax_content","cost_tax","tax_company","is_protect","cost_protect","cost_payment","currency","cur_rate","score_u","score_g","discount","pmt_goods","pmt_order","payed","memo","disabled","mark_text","cost_freight","order_refer","addon","source","confim_day","username","paytime","shiptime","evaluattime","refund_status","experience","volume","ship_area_china","province","city","dist","community","is_start","last_modifier","display"],'required','message'=>'{attribute}不能为空'],
           [['order_id'], 'exist','targetClass' => 'app\models\order\base', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_base');
        $obj->setData($form);
        $obj->setWhere(['order_id='=>$form->order_id]);
        return $obj->run();

    }
}