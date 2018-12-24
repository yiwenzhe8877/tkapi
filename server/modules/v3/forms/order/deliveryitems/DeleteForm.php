<?php

namespace app\modules\v3\forms\order\deliveryitems;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $item_id;

    public function addRule(){
        return [
            [['item_id'],'required','message'=>'{attribute}不能为空'],
            [['item_id'], 'exist','targetClass' => 'app\models\order\deliveryitems', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_deliveryitems');
        $obj->setWhere(['item_id='=>$form->item_id]);
        return $obj->run();

    }

}