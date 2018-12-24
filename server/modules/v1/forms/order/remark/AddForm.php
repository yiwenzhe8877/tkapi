<?php

namespace app\modules\v1\forms\order\remark;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $op_id;
	public $op_name;
	public $order_id;
	public $dateline;
	public $ip;
	public $ip_area;
	public $remark;
	


    public function addRule(){
        return [
            [["op_id","op_name","order_id","dateline","ip","ip_area","remark"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_remark');
        $obj->setData($form);
        return $obj->run();

    }
}