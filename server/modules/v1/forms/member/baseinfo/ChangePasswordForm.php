<?php

namespace app\modules\v1\forms\member\baseinfo;




use app\models\api\member\base\ChangePasswordApi;
use app\models\api\member\baseinfo\MemberBaseinfoApi;
use app\modules\v1\forms\CommonForm;


class ChangePasswordForm extends CommonForm
{
    public $password;
    public $passwordagain;
    public $member_id;

    public function addRule(){
        return [
            [['password','passwordagain','member_id'],'required','message'=>'{attribute}不能为空'],
            [['member_id'], 'exist','targetClass' => 'app\models\member\baseinfo', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        return MemberBaseinfoApi::changePwd($form->member_id,$form->password,$form->passwordagain);
    }

}