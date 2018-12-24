<?php

namespace app\modules\v2\forms\store\groupauth;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

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
        $obj->setTableName('store_groupauth');
        $obj->setData($form);
        return $obj->run();

    }
}