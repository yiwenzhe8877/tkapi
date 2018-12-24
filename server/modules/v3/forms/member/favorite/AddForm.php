<?php

namespace app\modules\v3\forms\member\favorite;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["member_id","goods_id","product_id","goods_name","goods_price","type","remark","createtime","sendtime","status","cellphone","email","disabled","pic1"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_favorite');
        $obj->setData($form);
        return $obj->run();

    }
}