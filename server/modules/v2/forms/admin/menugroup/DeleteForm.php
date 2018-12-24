<?php

namespace app\modules\v2\forms\admin\menugroup;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $menu_id;

    public function addRule(){
        return [
            [['menu_id'],'required','message'=>'{attribute}不能为空'],
            [['menu_id'], 'exist','targetClass' => 'app\models\admin\menugroup', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_menugroup');
        $obj->setWhere(['menu_id='=>$form->menu_id]);
        return $obj->run();

    }

}