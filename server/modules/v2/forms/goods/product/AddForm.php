<?php

namespace app\modules\v1\forms\goods\product;


use app\componments\sql\SqlCreate;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $goods_id;
    public $name;
    public $price;
    public $store;
    public $sku;


    public function addRule(){
        return [
            [['goods_id','name','price','store','sku'],'required','message'=>'{attribute}不能为空'],
            [['goods_id'], 'exist','targetClass' => 'app\models\goods\goods', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_product');
        $obj->setData($form);
        return $obj->run();

    }


}