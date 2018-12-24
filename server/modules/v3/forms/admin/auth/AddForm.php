<?php

namespace app\modules\v3\forms\admin\auth;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $name;
	public $module;
	public $service;
	public $sort;
	public $del;
	public $status;
	


    public function addRule(){
        return [
            [["name","module","service","sort","del","status"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('admin_auth');
        $obj->setData($form);
        return $obj->run();

    }
}