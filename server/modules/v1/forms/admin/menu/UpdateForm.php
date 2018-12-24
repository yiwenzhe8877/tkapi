<?php

namespace app\modules\v1\forms\admin\menu;


use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{
    public $menu_id;
    public $name;
    public $router;
    public $pid;


    public function addRule(){
        return [
            [['menu_id','name','router','pid'],'required','message'=>'{attribute}不能为空'],
            [['menu_id'], 'exist','targetClass' => 'app\models\admin\menu', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('admin_menu');
        $obj->setData($form);
        $obj->setWhere(['menu_id='=>$form->menu_id]);
        return $obj->run();

    }


}