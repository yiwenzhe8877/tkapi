<?php

namespace app\modules\v3\forms\store\setting;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $type;
	public $key;
	public $value;
	


    public function addRule(){
        return [
            [["store_id","type","key","value"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_setting');
        $obj->setData($form);
        return $obj->run();

    }
}