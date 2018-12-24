<?php

namespace app\modules\v3\forms\goods\category;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $classname;
	public $display;
	public $sort;
	public $level;
	public $pid;
	public $classtype;
	public $remark;
	


    public function addRule(){
        return [
            [["store_id","classname","display","sort","level","pid","classtype","remark"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_category');
        $obj->setData($form);
        return $obj->run();

    }
}