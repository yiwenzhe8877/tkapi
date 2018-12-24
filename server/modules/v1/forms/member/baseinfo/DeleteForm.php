<?php

namespace app\modules\v1\forms\member\baseinfo;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $member_id;

    public function addRule(){
        return [
            [['member_id'],'required','message'=>'{attribute}不能为空'],
            ['member_id', 'exist', 'targetClass' => 'app\models\member\baseinfo', 'message' => '{attribute}不存在。'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_baseinfo');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['member_id='=>$form->member_id]);
        return $obj->run();

    }

}