<?php

namespace app\modules\v1\forms\api\exceptionlog;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $username;
	public $group_name;
	public $range;
	public $time;
	public $class;
	public $method;
	public $line;
	public $code;
	public $msg;
	


    public function addRule(){
        return [
            [["username","group_name","range","time","class","method","line","code","msg"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('api_exceptionlog');
        $obj->setData($form);
        return $obj->run();

    }
}