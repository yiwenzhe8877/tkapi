<?php

namespace app\modules\v3\forms\api\exceptionlog;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $username;
	public $group_name;
	public $range;
	public $time;
	public $class;
	public $method;
	public $line;
	public $code;
	public $msg;
	


    public function addRule(){
       return [
           [["id","username","group_name","range","time","class","method","line","code","msg"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\api\exceptionlog', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('api_exceptionlog');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}