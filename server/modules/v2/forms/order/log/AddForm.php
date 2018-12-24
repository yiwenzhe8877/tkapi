<?php

namespace app\modules\v2\forms\order\log;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $order_id;
	public $op_id;
	public $op_name;
	public $dateline;
	public $behavior;
	public $result;
	public $log_text;
	public $addon;
	public $ip;
	public $ip_area;
	


    public function addRule(){
        return [
            [["order_id","op_id","op_name","dateline","behavior","result","log_text","addon","ip","ip_area"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_log');
        $obj->setData($form);
        return $obj->run();

    }
}