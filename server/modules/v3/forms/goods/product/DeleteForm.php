<?php

namespace app\modules\v3\forms\goods\product;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $product_id;

    public function addRule(){
        return [
            [['product_id'],'required','message'=>'{attribute}不能为空'],
            [['product_id'], 'exist','targetClass' => 'app\models\goods\product', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_product');
        $obj->setWhere(['product_id='=>$form->product_id]);
        return $obj->run();

    }

}