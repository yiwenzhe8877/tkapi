<?php

namespace app\modules\v2\forms\admin\user;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{
    public $admin_id;


    public $group_name;



    public function addRule(){
        return [
            [['admin_id','group_name'],'required','message'=>'{attribute}不能为空'],
            [['admin_id'], 'exist','targetClass' => 'app\models\admin\user', 'message' => '{attribute}不存在'],
            [['group_name'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],
        ];
    }




    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_user');
        $obj->setData($form);
        $obj->setWhere(['admin_id='=>$form->admin_id]);
        return $obj->run();

    }


}