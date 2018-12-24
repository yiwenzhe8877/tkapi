<?php

namespace app\modules\v2\forms\admin\groupauth;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $group_id;

    public function addRule(){
        return [
            [['group_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\admin\groupauth', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_groupauth');
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }

}