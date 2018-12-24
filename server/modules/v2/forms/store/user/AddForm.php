<?php

namespace app\modules\v2\forms\store\user;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $group_name;


    public function addRule(){
        return [
            [['group_name'],'required','message'=>'{attribute}不能为空'],
            ['group_name', 'unique', 'targetClass' => 'app\models\admin\group', 'message' => '{attribute}已经存在'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_user');
        $obj->setData($form);
        $obj->run();

    }
}