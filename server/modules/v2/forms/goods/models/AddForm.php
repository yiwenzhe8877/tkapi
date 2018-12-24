<?php

namespace app\modules\v1\forms\goods\category;


use app\componments\sql\SqlCreate;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $classid;
    public $name;
    public $choices;


    public function addRule(){
        return [
            [['classid','name','choices'],'required','message'=>'{attribute}不能为空'],
            [['classid'], 'exist','targetClass' => 'app\models\goods\category', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){


        $obj=new SqlCreate();
        $obj->setTableName('goods_models');
        $obj->setData($form);
        return $obj->run();
    }


}