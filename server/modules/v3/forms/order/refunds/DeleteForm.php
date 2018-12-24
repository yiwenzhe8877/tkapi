<?php

namespace app\modules\v3\forms\order\refunds;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $refund_id;

    public function addRule(){
        return [
            [['refund_id'],'required','message'=>'{attribute}不能为空'],
            [['refund_id'], 'exist','targetClass' => 'app\models\order\refunds', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_refunds');
        $obj->setWhere(['refund_id='=>$form->refund_id]);
        return $obj->run();

    }

}