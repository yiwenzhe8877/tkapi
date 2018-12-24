<?php

namespace app\modules\v1\forms\goods\product;


use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $product_id;

    public function addRule(){
        return [
            [['product_id'], 'exist','targetClass' => 'app\models\goods\product', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_product');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['product_id='=>$form->product_id]);
        return $obj->run();

    }

}