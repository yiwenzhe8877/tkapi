<?php

namespace app\modules\v3\forms\common\district;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $name;
	public $level;
	public $usetype;
	public $upid;
	public $displayorder;
	public $package;
	


    public function addRule(){
        return [
            [["name","level","usetype","upid","displayorder","package"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('common_district');
        $obj->setData($form);
        return $obj->run();

    }
}