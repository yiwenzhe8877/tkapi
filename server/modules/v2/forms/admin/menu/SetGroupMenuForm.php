<?php

namespace app\modules\v1\forms\admin\menu;



use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;

class SetGroupMenuForm extends CommonForm
{
    public $group_id;
    public $menu_id;




    public function addRule(){
        return [
            [['group_id','menu_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        return AdminGroupApi::setGroupMenu($form->group_id,$form->menu_id);

    }


}