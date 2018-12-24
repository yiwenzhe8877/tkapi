<?php

namespace app\modules\v3\forms\member\consult;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $con_id;
	public $member_id;
	public $username;
	public $goods_id;
	public $product_id;
	public $order_id;
	public $object_type;
	public $mem_read_status;
	public $adm_read_status;
	public $lastreply;
	public $reply_name;
	public $display;
	public $useful;
	public $replies;
	public $userdel;
	public $dateline;
	public $name;
	public $reply_uid;
	public $adm_write_status;
	public $contact;
	public $store_id;
	


    public function addRule(){
       return [
           [["con_id","member_id","username","goods_id","product_id","order_id","object_type","mem_read_status","adm_read_status","lastreply","reply_name","display","useful","replies","userdel","dateline","name","reply_uid","adm_write_status","contact","store_id"],'required','message'=>'{attribute}不能为空'],
           [['con_id'], 'exist','targetClass' => 'app\models\member\consult', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_consult');
        $obj->setData($form);
        $obj->setWhere(['con_id='=>$form->con_id]);
        return $obj->run();

    }
}