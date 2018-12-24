<?php

namespace app\modules\v1\forms\member\msg;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $msg_id;

    public function addRule(){
        return [
            [['msg_id'],'required','message'=>'{attribute}不能为空'],
            [['msg_id'], 'exist','targetClass' => 'app\models\member\msg', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_msg');
        $obj->setWhere(['msg_id='=>$form->msg_id]);
        return $obj->run();

    }

}