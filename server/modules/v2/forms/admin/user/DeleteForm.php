<?php

namespace app\modules\v2\forms\admin\user;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $admin_id;

    public function addRule(){
        return [
            [['admin_id'],'required','message'=>'{attribute}不能为空'],
            [['admin_id'], 'exist','targetClass' => 'app\models\admin\user', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_user');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['admin_id='=>$form->admin_id]);
        return $obj->run();

    }

}