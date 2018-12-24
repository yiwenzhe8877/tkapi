<?php

namespace app\modules\v3\forms\goods\product;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $product_id;
	public $goods_id;
	public $store_id;
	public $bn;
	public $weight;
	public $volume;
	public $bubn;
	public $marketable;
	public $sort;
	public $is_default;
	public $barcode;
	public $price;
	public $cost;
	public $mktprice;
	public $dateline;
	public $last_modify;
	public $store;
	public $store_place;
	public $freez;
	public $spec_desc;
	public $sku;
	public $addon;
	public $appprice;
	


    public function addRule(){
       return [
           [["product_id","goods_id","store_id","bn","weight","volume","bubn","marketable","sort","is_default","barcode","price","cost","mktprice","dateline","last_modify","store","store_place","freez","spec_desc","sku","addon","appprice"],'required','message'=>'{attribute}不能为空'],
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