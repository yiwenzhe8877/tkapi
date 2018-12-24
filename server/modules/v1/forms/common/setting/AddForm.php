<?php

namespace app\modules\v1\forms\common\setting;


use app\componments\sql\SqlCreate;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $classname;
    public $level;
    public $upid;


    public function addRule(){
        return [
            [['classname','level','upid'],'required','message'=>'{attribute}不能为空'],
            ['classname', 'unique', 'targetClass' => 'app\models\goods\category', 'message' => '{attribute}已经被使用。'],
        ];
    }


    public function run($form){
        $cover=[
            'classtype'=>'industy'
        ];

        $obj=new SqlCreate();
        $obj->setTableName('goods_category');
        $obj->setData($form);
        $obj->setCoverData($cover);
        return $obj->run();
    }


}