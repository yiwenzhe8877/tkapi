<?php

namespace app\modules\v3\forms\admin\group;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $group_id;
	public $group_name;
	public $status;
	public $del;
	public $is_default;
	


    public function addRule(){
       return [
           [["group_id","group_name","status","del","is_default"],'required','message'=>'{attribute}不能为空'],
           [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_group');
        $obj->setData($form);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }
}