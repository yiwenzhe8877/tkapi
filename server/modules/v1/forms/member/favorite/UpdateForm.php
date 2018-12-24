<?php

namespace app\modules\v1\forms\member\favorite;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $member_id;
	public $goods_id;
	public $product_id;
	public $goods_name;
	public $goods_price;
	public $type;
	public $remark;
	public $createtime;
	public $sendtime;
	public $status;
	public $cellphone;
	public $email;
	public $disabled;
	public $pic1;
	


    public function addRule(){
       return [
           [["id","member_id","goods_id","product_id","goods_name","goods_price","type","remark","createtime","sendtime","status","cellphone","email","disabled","pic1"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\favorite', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_favorite');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}