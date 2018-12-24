<?php

namespace app\modules\v1\forms\api\log;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $time;
	public $username;
	public $group;
	public $module;
	public $class;
	public $method;
	public $result;
	public $result_msg;
	


    public function addRule(){
        return [
            [["time","username","group","module","class","method","result","result_msg"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('api_log');
        $obj->setData($form);
        return $obj->run();

    }
}