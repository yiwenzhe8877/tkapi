<?php

namespace app\modules\v3\forms\store\group;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $group_name;
	public $status;
	public $del;
	public $is_default;
	


    public function addRule(){
        return [
            [["group_name","status","del","is_default"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_group');
        $obj->setData($form);
        return $obj->run();

    }
}