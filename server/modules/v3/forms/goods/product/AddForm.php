<?php

namespace app\modules\v3\forms\goods\product;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["goods_id","store_id","bn","weight","volume","bubn","marketable","sort","is_default","barcode","price","cost","mktprice","dateline","last_modify","store","store_place","freez","spec_desc","sku","addon","appprice"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_product');
        $obj->setData($form);
        return $obj->run();

    }
}