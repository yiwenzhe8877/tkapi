<?php

namespace app\modules\v1\forms\member\group;


use app\componments\sql\SqlCreate;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $group_name;


    public function addRule(){
        return [
            [['group_name'],'required','message'=>'{attribute}不能为空'],
            ['group_name', 'unique', 'targetClass' => 'app\models\member\group', 'message' => '{attribute}已经被使用。'],
        ];
    }

    public function run($form){


        $obj=new SqlCreate();
        $obj->setTableName('member_group');
        $obj->setData($form);
        return $obj->run();

    }


}