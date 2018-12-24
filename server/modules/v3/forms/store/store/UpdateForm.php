<?php

namespace app\modules\v3\forms\store\store;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
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
           [['store_id'], 'exist','targetClass' => 'app\models\store\store', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_store');
        $obj->setData($form);
        $obj->setWhere(['store_id='=>$form->store_id]);
        return $obj->run();

    }
}