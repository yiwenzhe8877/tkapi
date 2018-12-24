<?php

namespace app\modules\v3\forms\order\pmt;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $order_id;
	public $product_id;
	public $pmt_type;
	public $pmt_amount;
	public $pmt_tag;
	public $pmt_memo;
	public $pmt_describe;
	public $goods_id;
	


    public function addRule(){
        return [
            [["order_id","product_id","pmt_type","pmt_amount","pmt_tag","pmt_memo","pmt_describe","goods_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_pmt');
        $obj->setData($form);
        return $obj->run();

    }
}