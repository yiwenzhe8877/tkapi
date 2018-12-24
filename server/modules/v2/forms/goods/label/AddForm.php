<?php

namespace app\modules\v2\forms\goods\label;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	


    public function addRule(){
        return [
            [["store_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_label');
        $obj->setData($form);
        return $obj->run();

    }
}