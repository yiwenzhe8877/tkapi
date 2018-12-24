<?php

namespace app\modules\v3\forms\order\delivery;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $delivery_id;

    public function addRule(){
        return [
            [['delivery_id'],'required','message'=>'{attribute}不能为空'],
            [['delivery_id'], 'exist','targetClass' => 'app\models\order\delivery', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_delivery');
        $obj->setWhere(['delivery_id='=>$form->delivery_id]);
        return $obj->run();

    }

}