<?php

namespace app\modules\v3\forms\store\menugroup;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $group_id;
	public $is_enable;
	


    public function addRule(){
        return [
            [["group_id","is_enable"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_menugroup');
        $obj->setData($form);
        return $obj->run();

    }
}