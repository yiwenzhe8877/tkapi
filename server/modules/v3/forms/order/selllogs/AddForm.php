<?php

namespace app\modules\v3\forms\order\selllogs;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $order_id;
	public $username;
	public $price;
	public $product_id;
	public $goods_id;
	public $name;
	public $sku;
	public $nums;
	public $dateline;
	


    public function addRule(){
        return [
            [["member_id","order_id","username","price","product_id","goods_id","name","sku","nums","dateline"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_selllogs');
        $obj->setData($form);
        return $obj->run();

    }
}