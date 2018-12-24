<?php

namespace app\modules\v2\forms\store\operatorlogs;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $username;
	public $user_id;
	public $module;
	public $controller;
	public $action;
	public $dateline;
	public $ip;
	public $ip_area;
	public $memo;
	public $memo_before;
	


    public function addRule(){
        return [
            [["username","user_id","module","controller","action","dateline","ip","ip_area","memo","memo_before"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_operatorlogs');
        $obj->setData($form);
        return $obj->run();

    }
}