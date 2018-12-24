<?php

namespace app\modules\v3\forms\member\sysmsg;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $msg_id;
	public $admin_id;
	public $username;
	public $to_type;
	public $subject;
	public $pc_content;
	public $ip;
	public $ip_area;
	public $dateline;
	public $expiration;
	public $disabled;
	public $svalue;
	public $wap_content;
	public $sendall;
	public $sendorder;
	public $sendnoorder;
	public $sendgroupid;
	public $sendmember;
	


    public function addRule(){
       return [
           [["msg_id","admin_id","username","to_type","subject","pc_content","ip","ip_area","dateline","expiration","disabled","svalue","wap_content","sendall","sendorder","sendnoorder","sendgroupid","sendmember"],'required','message'=>'{attribute}不能为空'],
           [['msg_id'], 'exist','targetClass' => 'app\models\member\sysmsg', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_sysmsg');
        $obj->setData($form);
        $obj->setWhere(['msg_id='=>$form->msg_id]);
        return $obj->run();

    }
}