<?php

namespace app\modules\v2\forms\goods\goods;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $goods_id;
	public $store_id;
	public $name;
	public $sell_point;
	public $price;
	public $pc_content;
	public $wap_content;
	public $store_algorithm;
	public $createtime;
	public $marketable;
	public $last_modify;
	public $sales;
	public $views;
	public $evaluat;
	public $products;
	public $store;
	public $pic1;
	public $pic2;
	public $pic3;
	public $pic4;
	public $pic5;
	public $cost;
	public $mktprice;
	public $show_stock;
	public $express_type;
	public $express_id;
	public $express_price;
	public $limit_buy;
	public $can_add_cart;
	public $del;
	


    public function addRule(){
       return [
           [["goods_id","store_id","name","sell_point","price","pc_content","wap_content","store_algorithm","createtime","marketable","last_modify","sales","views","evaluat","products","store","pic1","pic2","pic3","pic4","pic5","cost","mktprice","show_stock","express_type","express_id","express_price","limit_buy","can_add_cart","del"],'required','message'=>'{attribute}不能为空'],
           [['goods_id'], 'exist','targetClass' => 'app\models\goods\goods', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_goods');
        $obj->setData($form);
        $obj->setWhere(['goods_id='=>$form->goods_id]);
        return $obj->run();

    }
}