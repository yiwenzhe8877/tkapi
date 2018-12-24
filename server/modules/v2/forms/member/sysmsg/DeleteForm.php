<?php

namespace app\modules\v2\forms\member\sysmsg;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $msg_id;

    public function addRule(){
        return [
            [['msg_id'],'required','message'=>'{attribute}不能为空'],
            [['msg_id'], 'exist','targetClass' => 'app\models\member\sysmsg', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_sysmsg');
        $obj->setWhere(['msg_id='=>$form->msg_id]);
        return $obj->run();

    }

}