<?php

namespace app\modules\v3\forms\apitest\usercase;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $id;

    public function addRule(){
        return [
            [['id'],'required','message'=>'{attribute}不能为空'],
            [['id'], 'exist','targetClass' => 'app\models\apitest\usercase', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('apitest_usercase');
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }

}