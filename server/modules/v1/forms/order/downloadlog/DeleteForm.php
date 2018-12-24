<?php

namespace app\modules\v1\forms\order\downloadlog;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $id;

    public function addRule(){
        return [
            [['id'],'required','message'=>'{attribute}不能为空'],
            [['id'], 'exist','targetClass' => 'app\models\order\downloadlog', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_downloadlog');
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }

}