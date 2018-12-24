<?php

namespace app\modules\v3\forms\member\consult;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $con_id;

    public function addRule(){
        return [
            [['con_id'],'required','message'=>'{attribute}不能为空'],
            [['con_id'], 'exist','targetClass' => 'app\models\member\consult', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_consult');
        $obj->setWhere(['con_id='=>$form->con_id]);
        return $obj->run();

    }

}