<?php

namespace app\modules\v3\forms\admin\auth;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $auth_id;
	public $name;
	public $module;
	public $service;
	public $sort;
	public $del;
	public $status;
	


    public function addRule(){
       return [
           [["auth_id","name","module","service","sort","del","status"],'required','message'=>'{attribute}不能为空'],
           [['auth_id'], 'exist','targetClass' => 'app\models\admin\auth', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_auth');
        $obj->setData($form);
        $obj->setWhere(['auth_id='=>$form->auth_id]);
        return $obj->run();

    }
}