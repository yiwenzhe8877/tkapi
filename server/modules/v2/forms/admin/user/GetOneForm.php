<?php

namespace app\modules\v2\forms\admin\user;


use app\models\api\admin\user\GetAdminUserApi;
use app\modules\v2\forms\CommonForm;

class GetOneForm extends CommonForm
{
    public $admin_id;

    public function addRule(){
        return [
            [['admin_id'],'required','message'=>'{attribute}不能为空'],
            [['admin_id'], 'exist','targetClass' => 'app\models\admin\user', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        return GetAdminUserApi::getById($form->admin_id);
    }

}