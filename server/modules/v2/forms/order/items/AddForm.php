<?php

namespace app\modules\v2\forms\order\items;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $order_id;
	public $goods_id;
	public $product_id;
	public $name;
	public $cost;
	public $price;
	public $g_price;
	public $amount;
	public $score;
	public $weight;
	public $nums;
	public $sendnum;
	public $addon;
	public $item_type;
	public $refund_status;
	public $ship_status;
	public $sku;
	public $sn_id;
	public $volume;
	public $refunds_type;
	public $pay_status;
	public $bn;
	


    public function addRule(){
        return [
            [["order_id","goods_id","product_id","name","cost","price","g_price","amount","score","weight","nums","sendnum","addon","item_type","refund_status","ship_status","sku","sn_id","volume","refunds_type","pay_status","bn"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_items');
        $obj->setData($form);
        return $obj->run();

    }
}