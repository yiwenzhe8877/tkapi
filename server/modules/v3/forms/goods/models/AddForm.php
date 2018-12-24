<?php

namespace app\modules\v3\forms\goods\models;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $classid;
	public $name;
	public $choices;
	public $is_enable;
	public $sort;
	public $del;
	


    public function addRule(){
        return [
            [["store_id","classid","name","choices","is_enable","sort","del"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_models');
        $obj->setData($form);
        return $obj->run();

    }
}