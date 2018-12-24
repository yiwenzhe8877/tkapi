<?php

namespace app\modules\v1\forms\admin\group;


use app\componments\sql\SqlCreate;
use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $group_name;


    public function addRule(){
        return [
            ['group_name','required','message'=>'管理组名称不能为空'],
            ['group_name', 'unique', 'targetClass' => 'app\models\admin\group', 'message' => '{attribute}已经存在'],
        ];
    }




    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('admin_group');
        $obj->setData($form);
        $obj->run();

        //同步到groupauth
        return AdminGroupApi::syncAuths();
    }
}