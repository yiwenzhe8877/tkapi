<?php

namespace app\modules\v1\forms\admin\group;


use app\componments\sql\SqlUpdate;
use app\componments\utils\Assert;
use app\models\api\admin\group\ForbidAdminGroupApi;
use app\modules\v1\forms\CommonForm;

class ForbiddenForm extends CommonForm
{
    public $group_id;


    public function run($form){

        Assert::RecordNotExist('admin_group',['group_id='=>$form->group_id]);

        $obj=new SqlUpdate();
        $obj->setTableName('admin_group');
        $obj->setData(['status'=>0]);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();
    }

}