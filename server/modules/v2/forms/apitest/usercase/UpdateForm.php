<?php

namespace app\modules\v2\forms\apitest\usercase;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $env;
	public $url;
	public $service;
	public $token;
	public $data;
	public $code;
	public $code_msg;
	


    public function addRule(){
       return [
           [["id","env","url","service","token","data","code","code_msg"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\apitest\usercase', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('apitest_usercase');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}