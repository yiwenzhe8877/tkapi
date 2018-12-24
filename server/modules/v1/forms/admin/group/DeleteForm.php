<?php

namespace app\modules\v1\forms\admin\group;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $group_id;


    public function rules()
    {
        return [
            [['group_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_group');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();
    }

}