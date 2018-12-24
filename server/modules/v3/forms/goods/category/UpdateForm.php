<?php

namespace app\modules\v3\forms\goods\category;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $classid;
	public $store_id;
	public $classname;
	public $display;
	public $sort;
	public $level;
	public $pid;
	public $classtype;
	public $remark;
	


    public function addRule(){
       return [
           [["classid","store_id","classname","display","sort","level","pid","classtype","remark"],'required','message'=>'{attribute}不能为空'],
           [['classid'], 'exist','targetClass' => 'app\models\goods\category', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_category');
        $obj->setData($form);
        $obj->setWhere(['classid='=>$form->classid]);
        return $obj->run();

    }
}