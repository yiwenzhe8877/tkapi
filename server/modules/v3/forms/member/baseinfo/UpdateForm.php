<?php

namespace app\modules\v3\forms\member\baseinfo;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $member_id;
	public $store_id;
	public $pam_account;
	public $pam_openid;
	public $pam_phone;
	public $pam_email;
	public $pam_unionid;
	public $password;
	public $paypassword;
	public $auth_key;
	public $is_locked;
	public $group_id;
	public $group_name;
	public $money;
	public $point;
	public $experience;
	public $regdate;
	public $regip;
	public $regip_area;
	public $source;
	public $ordernum;
	public $newprompt;
	public $emailstatus;
	public $mobilestatus;
	public $nickname;
	public $wxnumber;
	public $realname;
	public $zhifubao;
	public $parent_openid;
	public $del;
	


    public function addRule(){
       return [
           [["member_id","store_id","pam_account","pam_openid","pam_phone","pam_email","pam_unionid","password","paypassword","auth_key","is_locked","group_id","group_name","money","point","experience","regdate","regip","regip_area","source","ordernum","newprompt","emailstatus","mobilestatus","nickname","wxnumber","realname","zhifubao","parent_openid","del"],'required','message'=>'{attribute}不能为空'],
           [['member_id'], 'exist','targetClass' => 'app\models\member\baseinfo', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_baseinfo');
        $obj->setData($form);
        $obj->setWhere(['member_id='=>$form->member_id]);
        return $obj->run();

    }
}