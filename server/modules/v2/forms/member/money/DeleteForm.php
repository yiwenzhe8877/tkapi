<?php

namespace app\modules\v2\forms\member\money;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $logid;

    public function addRule(){
        return [
            [['logid'],'required','message'=>'{attribute}不能为空'],
            [['logid'], 'exist','targetClass' => 'app\models\member\money', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_money');
        $obj->setWhere(['logid='=>$form->logid]);
        return $obj->run();

    }

}