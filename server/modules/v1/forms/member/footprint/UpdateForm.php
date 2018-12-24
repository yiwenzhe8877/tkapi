<?php

namespace app\modules\v1\forms\member\footprint;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $member_id;
	public $store_id;
	public $goods_id;
	public $product_id;
	public $goods_name;
	public $goods_price;
	public $dateline;
	public $pic1;
	


    public function addRule(){
       return [
           [["id","member_id","store_id","goods_id","product_id","goods_name","goods_price","dateline","pic1"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\footprint', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_footprint');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}