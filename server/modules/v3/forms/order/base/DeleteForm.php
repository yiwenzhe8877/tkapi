<?php

namespace app\modules\v3\forms\order\base;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $order_id;

    public function addRule(){
        return [
            [['order_id'],'required','message'=>'{attribute}不能为空'],
            [['order_id'], 'exist','targetClass' => 'app\models\order\base', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_base');
        $obj->setWhere(['order_id='=>$form->order_id]);
        return $obj->run();

    }

}