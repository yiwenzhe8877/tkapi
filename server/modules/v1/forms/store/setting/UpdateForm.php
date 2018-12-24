<?php

namespace app\modules\v1\forms\store\setting;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


    public $group_id;


    public function addRule(){
        return [
            [['group_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\member\group', 'message' => '用户组不存在'],
        ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_setting');
        $obj->setData($form);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }
}