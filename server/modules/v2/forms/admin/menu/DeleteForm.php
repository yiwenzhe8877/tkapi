<?php

namespace app\modules\v1\forms\admin\menu;


use app\componments\sql\SqlUpdate;
use app\models\AdminAuth;
use app\models\AdminMenu;
use app\modules\v1\forms\CommonForm;
use app\componments\utils\ApiException;

class DeleteForm extends CommonForm
{
    public $menu_id;


    public function addRule(){
        return [
            [['menu_id'],'required','message'=>'{attribute}不能为空'],
            [['menu_id'], 'exist','targetClass' => 'app\models\admin\menu', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('admin_menu');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['menu_id='=>$form->menu_id]);
        return $obj->run();

    }

}