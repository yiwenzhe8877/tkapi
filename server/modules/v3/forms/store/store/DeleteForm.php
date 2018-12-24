<?php

namespace app\modules\v3\forms\store\store;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $store_id;

    public function addRule(){
        return [
            [['store_id'],'required','message'=>'{attribute}不能为空'],
            [['store_id'], 'exist','targetClass' => 'app\models\store\store', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('store_store');
        $obj->setWhere(['store_id='=>$form->store_id]);
        return $obj->run();

    }

}