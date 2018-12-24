<?php

namespace app\modules\v1\forms\order\payments;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $payment_id;

    public function addRule(){
        return [
            [['payment_id'],'required','message'=>'{attribute}不能为空'],
            [['payment_id'], 'exist','targetClass' => 'app\models\order\payments', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_payments');
        $obj->setWhere(['payment_id='=>$form->payment_id]);
        return $obj->run();

    }

}