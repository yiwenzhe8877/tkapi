<?php

namespace app\modules\v1\forms\store\groupauth;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $group_id;
	public $auth_id;
	public $is_enable;
	


    public function addRule(){
       return [
           [["group_id","auth_id","is_enable"],'required','message'=>'{attribute}不能为空'],
           [['group_id'], 'exist','targetClass' => 'app\models\store\groupauth', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_groupauth');
        $obj->setData($form);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }
}