<?php

namespace app\modules\v1\forms\store\user;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $shop_name;
	public $username;
	public $password;
	public $shop_owner;
	public $group_id;
	public $group_name;
	public $auth_key;
	public $status;
	public $del;
	public $avatar;
	


    public function addRule(){
        return [
            [["store_id","shop_name","username","password","shop_owner","group_id","group_name","auth_key","status","del","avatar"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_user');
        $obj->setData($form);
        return $obj->run();

    }
}