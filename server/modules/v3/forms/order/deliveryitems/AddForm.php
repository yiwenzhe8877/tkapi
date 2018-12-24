<?php

namespace app\modules\v3\forms\order\deliveryitems;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $delivery_id;
	public $order_item_id;
	public $item_type;
	public $product_id;
	public $product_bn;
	public $product_name;
	public $number;
	public $product_sku;
	public $goods_id;
	


    public function addRule(){
        return [
            [["delivery_id","order_item_id","item_type","product_id","product_bn","product_name","number","product_sku","goods_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_deliveryitems');
        $obj->setData($form);
        return $obj->run();

    }
}