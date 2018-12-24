<?php

namespace app\modules\v3\forms\admin\menu;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $name;
	public $router;
	public $pid;
	public $sort;
	public $del;
	


    public function addRule(){
        return [
            [["name","router","pid","sort","del"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('admin_menu');
        $obj->setData($form);
        return $obj->run();

    }
}