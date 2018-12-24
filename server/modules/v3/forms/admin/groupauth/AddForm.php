<?php

namespace app\modules\v3\forms\admin\groupauth;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $auth_id;
	public $is_enable;
	


    public function addRule(){
        return [
            [["auth_id","is_enable"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('admin_groupauth');
        $obj->setData($form);
        return $obj->run();

    }
}