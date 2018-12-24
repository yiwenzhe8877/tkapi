<?php

namespace app\modules\v1\forms\goods\category;


use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $id;

    public function addRule(){
        return [
            [['id'], 'exist','targetClass' => 'app\models\goods\models', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_models');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}