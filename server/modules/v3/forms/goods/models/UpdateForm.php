<?php

namespace app\modules\v3\forms\goods\models;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $store_id;
	public $classid;
	public $name;
	public $choices;
	public $is_enable;
	public $sort;
	public $del;
	


    public function addRule(){
       return [
           [["id","store_id","classid","name","choices","is_enable","sort","del"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\goods\models', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_models');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}