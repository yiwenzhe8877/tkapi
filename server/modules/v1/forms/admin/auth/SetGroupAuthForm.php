<?php

namespace app\modules\v1\forms\admin\auth;


use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;

class SetGroupAuthForm extends CommonForm
{
    public $group_id;
    public $auth_id;


    public function addRule(){
        return [
            [['group_id','auth_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],

        ];
    }

    public function run($form){


        return AdminGroupApi::setGroupAuths($form->group_id,$form->auth_id);

    }


}