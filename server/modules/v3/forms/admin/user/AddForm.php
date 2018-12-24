<?php

namespace app\modules\v3\forms\admin\user;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["username","password","nickname","phone","group_id","group_name","auth_key","status","del","avatar"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('admin_user');
        $obj->setData($form);
        return $obj->run();

    }
}