<?php

namespace app\modules\v3\forms\store\user;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $user_id;

    public function addRule(){
        return [
            [['user_id'],'required','message'=>'{attribute}不能为空'],
            [['user_id'], 'exist','targetClass' => 'app\models\store\user', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('store_user');
        $obj->setWhere(['user_id='=>$form->user_id]);
        return $obj->run();

    }

}