<?php

namespace app\modules\v3\forms\store\auth;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $name;
	public $module;
	public $controller;
	public $action;
	public $sort;
	public $del;
	public $status;
	


    public function addRule(){
        return [
            [["name","module","controller","action","sort","del","status"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_auth');
        $obj->setData($form);
        return $obj->run();

    }
}