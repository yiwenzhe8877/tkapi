<?php

namespace app\modules\v1\forms\member\cart;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $store_id;
	public $member_id;
	public $product_id;
	public $goods_id;
	public $num;
	


    public function addRule(){
       return [
           [["id","store_id","member_id","product_id","goods_id","num"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\cart', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_cart');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}