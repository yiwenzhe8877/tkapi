<?php

namespace app\modules\v3\forms\member\consult;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["member_id","username","goods_id","product_id","order_id","object_type","mem_read_status","adm_read_status","lastreply","reply_name","display","useful","replies","userdel","dateline","name","reply_uid","adm_write_status","contact","store_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_consult');
        $obj->setData($form);
        return $obj->run();

    }
}