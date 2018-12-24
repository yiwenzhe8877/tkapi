<?php

namespace app\modules\v1\forms\member\group;



use app\models\admin\menugroup;
use app\models\api\member\group\MemberGroupApi;
use app\models\member\group;
use app\modules\v1\forms\CommonForm;


class SetDefaultForm extends CommonForm
{

    public $group_id;


    public function addRule(){
        return [
            [['group_id'],'required','message'=>'{attribute}不能为空'],
            [['group_id'], 'exist','targetClass' => 'app\models\member\group', 'message' => '用户组不存在'],
        ];
    }



    public function run($form){


        $group=MemberGroupApi::getDefaultGroup();
        group::updateAll([
            'is_default'=>0
        ],[
            'group_id'=>$group->group_id
        ]);

        group::updateAll([
            'is_default'=>1
        ],[
            'group_id'=>$form->group_id
        ]);

        return "";
    }

}