<?php

namespace app\modules\v1\forms\member\address;



use app\componments\sql\SqlUpdate;
use app\models\api\member\address\SetDefaultAddressApi;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


    public $product_id;
    public $goods_id;
    public $name;
    public $price;
    public $store;
    public $sku;


    public function addRule(){
        return [
            [['goods_id','name','price','store','sku','goods_id'],'required','message'=>'{attribute}不能为空'],
            [['goods_id'], 'exist','targetClass' => 'app\models\goods\goods', 'message' => '{attribute}不存在'],
            [['product_id'], 'exist','targetClass' => 'app\models\goods\product', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){


        $obj=new SqlUpdate();
        $obj->setTableName('goods_product');
        $obj->setData($form);
        $obj->setWhere(['product_id='=>$form->product_id]);
        return $obj->run();

    }


}