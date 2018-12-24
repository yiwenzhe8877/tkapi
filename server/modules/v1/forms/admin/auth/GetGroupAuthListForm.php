<?php

namespace app\modules\v1\forms\admin\auth;


use app\models\admin\auth;
use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\auth\AuthService;


class GetGroupAuthListForm extends CommonForm
{
    public $pageNum;
    public $group_id;



    public function addRule(){
        return [
            [['pageNum','group_id'],'required','message'=>'{attribute}不能为空'],

            [['group_id'], 'exist','targetClass' => 'app\models\admin\group', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){

        return AdminGroupApi::getAuthsListByGroupId($form->pageNum,$form->group_id);

    }

}