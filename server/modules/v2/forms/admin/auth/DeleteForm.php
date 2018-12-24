<?php

namespace app\modules\v1\forms\admin\auth;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $auth_id;


    public function addRule(){
        return [
            [['auth_id'],'required','message'=>'{attribute}不能为空'],
            [['auth_id'], 'exist','targetClass' => 'app\models\admin\auth', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_auth');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['auth_id='=>$form->auth_id]);
        return $obj->run();

    }

}