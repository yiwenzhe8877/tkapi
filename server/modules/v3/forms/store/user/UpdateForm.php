<?php

namespace app\modules\v3\forms\store\user;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $user_id;
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
           [["user_id","store_id","shop_name","username","password","shop_owner","group_id","group_name","auth_key","status","del","avatar"],'required','message'=>'{attribute}不能为空'],
           [['user_id'], 'exist','targetClass' => 'app\models\store\user', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_user');
        $obj->setData($form);
        $obj->setWhere(['user_id='=>$form->user_id]);
        return $obj->run();

    }
}