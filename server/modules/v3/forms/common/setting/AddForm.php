<?php

namespace app\modules\v3\forms\common\setting;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $type;
	public $key;
	public $value;
	


    public function addRule(){
        return [
            [["type","key","value"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('common_setting');
        $obj->setData($form);
        return $obj->run();

    }
}