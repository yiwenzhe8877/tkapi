<?php

namespace app\modules\v2\forms\member\cart;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $member_id;
	public $product_id;
	public $goods_id;
	public $num;
	


    public function addRule(){
        return [
            [["store_id","member_id","product_id","goods_id","num"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_cart');
        $obj->setData($form);
        return $obj->run();

    }
}