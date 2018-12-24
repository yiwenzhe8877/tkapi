<?php

namespace app\modules\v1\forms\member\msg;


use app\models\api\member\msg\ReadMsgApi;
use app\modules\v1\forms\CommonForm;

class SetReadForm extends CommonForm
{


    public $msg_id;


    public function addRule(){
        return [
            [['msg_id'],'required','message'=>'{attribute}不能为空'],
            [['msg_id'], 'exist','targetClass' => 'app\models\member\msg', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        return ReadMsgApi::setIsRead($form->msg_id);

    }


}