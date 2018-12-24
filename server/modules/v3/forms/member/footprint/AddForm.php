<?php

namespace app\modules\v3\forms\member\footprint;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $store_id;
	public $goods_id;
	public $product_id;
	public $goods_name;
	public $goods_price;
	public $dateline;
	public $pic1;
	


    public function addRule(){
        return [
            [["member_id","store_id","goods_id","product_id","goods_name","goods_price","dateline","pic1"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_footprint');
        $obj->setData($form);
        return $obj->run();

    }
}