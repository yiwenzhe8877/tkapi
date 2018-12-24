<?php

namespace app\modules\v3\forms\store\store;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["shop_name","username","password","shop_owner","group_id","group_name","auth_key","status","del","avatar"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('store_store');
        $obj->setData($form);
        return $obj->run();

    }
}