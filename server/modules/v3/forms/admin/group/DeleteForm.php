<?php

namespace app\modules\v3\forms\admin\group;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $group_id;

    public function addRule(){
        return [
            [['group_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_group');
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }

}