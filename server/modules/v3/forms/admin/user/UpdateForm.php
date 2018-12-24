<?php

namespace app\modules\v3\forms\admin\user;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $admin_id;
	public $username;
	public $password;
	public $nickname;
	public $phone;
	public $group_id;
	public $group_name;
	public $auth_key;
	public $status;
	public $del;
	public $avatar;
	


    public function addRule(){
       return [
           [["admin_id","username","password","nickname","phone","group_id","group_name","auth_key","status","del","avatar"],'required','message'=>'{attribute}不能为空'],
           [['admin_id'], 'exist','targetClass' => 'app\models\admin\user', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_user');
        $obj->setData($form);
        $obj->setWhere(['admin_id='=>$form->admin_id]);
        return $obj->run();

    }
}