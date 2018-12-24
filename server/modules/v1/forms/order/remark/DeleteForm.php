<?php

namespace app\modules\v1\forms\order\remark;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $remark_id;

    public function addRule(){
        return [
            [['remark_id'],'required','message'=>'{attribute}不能为空'],
            [['remark_id'], 'exist','targetClass' => 'app\models\order\remark', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_remark');
        $obj->setWhere(['remark_id='=>$form->remark_id]);
        return $obj->run();

    }

}