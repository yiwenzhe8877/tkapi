<?php

namespace app\modules\v3\forms\member\evaluat;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $username;
	public $goods_id;
	public $product_id;
	public $order_id;
	public $dateline;
	public $display;
	public $useful;
	public $replies;
	public $userdel;
	public $goods_name;
	public $eval_type;
	public $point_goods;
	public $point_service;
	public $point_express;
	public $adm_write_status;
	public $adm_read_status;
	public $issystem;
	public $store_id;
	


    public function addRule(){
        return [
            [["member_id","username","goods_id","product_id","order_id","dateline","display","useful","replies","userdel","goods_name","eval_type","point_goods","point_service","point_express","adm_write_status","adm_read_status","issystem","store_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_evaluat');
        $obj->setData($form);
        return $obj->run();

    }
}