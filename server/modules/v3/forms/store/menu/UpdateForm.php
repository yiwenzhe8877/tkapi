<?php

namespace app\modules\v3\forms\store\menu;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $name;
	public $ename;
	public $router;
	public $pid;
	public $sort;
	public $del;
	


    public function addRule(){
       return [
           [["id","name","ename","router","pid","sort","del"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\store\menu', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_menu');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}