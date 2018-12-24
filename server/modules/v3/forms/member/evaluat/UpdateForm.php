<?php

namespace app\modules\v3\forms\member\evaluat;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
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
           [["id","member_id","username","goods_id","product_id","order_id","dateline","display","useful","replies","userdel","goods_name","eval_type","point_goods","point_service","point_express","adm_write_status","adm_read_status","issystem","store_id"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\evaluat', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_evaluat');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}