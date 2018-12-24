<?php

namespace app\modules\v1\forms\member\msg;


use app\componments\sql\SqlCreate;
use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\models\api\member\base\GetMemberInfoApi;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{


    public $member_id;
    public $title;
    public $content;

    public function addRule(){
        return [
            [['title','content'],'required','message'=>'{attribute}不能为空'],
            [['member_id'], 'exist','targetClass' => 'app\models\member\base', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){


        $cover=[
            'to_uid'=>$form->member_id,
            'to_username'=>GetMemberInfoApi::getNameById($form->member_id),
            'from_uid'=> GetLoginedAdminUserApi::getUid(),
            'from_username'=> GetLoginedAdminUserApi::getName(),
            'createtime'=>time()
        ];
        $unsave=['member_id'];

        $obj=new SqlCreate();
        $obj->setTableName('member_msg');
        $obj->setData($form);
        $obj->setCoverData($cover);
        $obj->setUnsavefields($unsave);

        return $obj->run();

    }


}