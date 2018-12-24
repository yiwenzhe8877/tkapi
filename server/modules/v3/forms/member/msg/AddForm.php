<?php

namespace app\modules\v3\forms\member\msg;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $from_store_id;
	public $from_username;
	public $to_uid;
	public $to_username;
	public $content;
	public $title;
	public $createtime;
	public $is_read;
	public $replies;
	public $lastreply;
	public $reply_name;
	public $disabled;
	public $fromdel;
	public $todel;
	


    public function addRule(){
        return [
            [["from_store_id","from_username","to_uid","to_username","content","title","createtime","is_read","replies","lastreply","reply_name","disabled","fromdel","todel"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_msg');
        $obj->setData($form);
        return $obj->run();

    }
}