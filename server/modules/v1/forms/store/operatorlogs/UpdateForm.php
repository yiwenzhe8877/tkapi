<?php

namespace app\modules\v1\forms\store\operatorlogs;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $log_id;
	public $username;
	public $user_id;
	public $module;
	public $controller;
	public $action;
	public $dateline;
	public $ip;
	public $ip_area;
	public $memo;
	public $memo_before;
	


    public function addRule(){
       return [
           [["log_id","username","user_id","module","controller","action","dateline","ip","ip_area","memo","memo_before"],'required','message'=>'{attribute}不能为空'],
           [['log_id'], 'exist','targetClass' => 'app\models\store\operatorlogs', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_operatorlogs');
        $obj->setData($form);
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }
}