<?php

namespace app\modules\v2\forms\order\deliveryitems;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $item_id;
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
           [["item_id","delivery_id","order_item_id","item_type","product_id","product_bn","product_name","number","product_sku","goods_id"],'required','message'=>'{attribute}不能为空'],
           [['item_id'], 'exist','targetClass' => 'app\models\order\deliveryitems', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_deliveryitems');
        $obj->setData($form);
        $obj->setWhere(['item_id='=>$form->item_id]);
        return $obj->run();

    }
}