<?php

namespace app\modules\v3\forms\member\msg;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $msg_id;
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
           [["msg_id","from_store_id","from_username","to_uid","to_username","content","title","createtime","is_read","replies","lastreply","reply_name","disabled","fromdel","todel"],'required','message'=>'{attribute}不能为空'],
           [['msg_id'], 'exist','targetClass' => 'app\models\member\msg', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_msg');
        $obj->setData($form);
        $obj->setWhere(['msg_id='=>$form->msg_id]);
        return $obj->run();

    }
}