<?php

namespace app\modules\v1\forms\apitest\usercase;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $env;
	public $url;
	public $service;
	public $token;
	public $data;
	public $code;
	public $code_msg;
	


    public function addRule(){
        return [
            [["env","url","service","token","data","code","code_msg"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('apitest_usercase');
        $obj->setData($form);
        return $obj->run();

    }
}