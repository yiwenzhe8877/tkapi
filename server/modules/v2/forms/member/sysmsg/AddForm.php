<?php

namespace app\modules\v2\forms\member\sysmsg;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
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
            [["admin_id","username","to_type","subject","pc_content","ip","ip_area","dateline","expiration","disabled","svalue","wap_content","sendall","sendorder","sendnoorder","sendgroupid","sendmember"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_sysmsg');
        $obj->setData($form);
        return $obj->run();

    }
}