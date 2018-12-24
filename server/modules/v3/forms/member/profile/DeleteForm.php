<?php

namespace app\modules\v3\forms\member\profile;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $member_id;

    public function addRule(){
        return [
            [['member_id'],'required','message'=>'{attribute}不能为空'],
            [['member_id'], 'exist','targetClass' => 'app\models\member\profile', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_profile');
        $obj->setWhere(['member_id='=>$form->member_id]);
        return $obj->run();

    }

}