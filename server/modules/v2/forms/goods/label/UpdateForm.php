<?php

namespace app\modules\v2\forms\goods\label;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $label_id;
	public $store_id;
	


    public function addRule(){
       return [
           [["label_id","store_id"],'required','message'=>'{attribute}不能为空'],
           [['label_id'], 'exist','targetClass' => 'app\models\goods\label', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_label');
        $obj->setData($form);
        $obj->setWhere(['label_id='=>$form->label_id]);
        return $obj->run();

    }
}