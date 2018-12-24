<?php

namespace app\modules\v3\forms\store\menugroup;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $menu_id;
	public $group_id;
	public $is_enable;
	


    public function addRule(){
       return [
           [["menu_id","group_id","is_enable"],'required','message'=>'{attribute}不能为空'],
           [['menu_id'], 'exist','targetClass' => 'app\models\store\menugroup', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('store_menugroup');
        $obj->setData($form);
        $obj->setWhere(['menu_id='=>$form->menu_id]);
        return $obj->run();

    }
}