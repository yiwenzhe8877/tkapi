<?php

namespace app\modules\v2\forms\member\comment;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $dis_id;

    public function addRule(){
        return [
            [['dis_id'],'required','message'=>'{attribute}不能为空'],
            [['dis_id'], 'exist','targetClass' => 'app\models\member\comment', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_comment');
        $obj->setWhere(['dis_id='=>$form->dis_id]);
        return $obj->run();

    }

}