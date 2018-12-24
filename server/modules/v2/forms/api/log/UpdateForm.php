<?php

namespace app\modules\v2\forms\api\log;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $time;
	public $username;
	public $group;
	public $module;
	public $class;
	public $method;
	public $result;
	public $result_msg;
	


    public function addRule(){
       return [
           [["id","time","username","group","module","class","method","result","result_msg"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\api\log', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('api_log');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}