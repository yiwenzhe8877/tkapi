<?php

namespace app\modules\v1\forms\goods\product;


use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $log_id;

    public function addRule(){
        return [
            [['log_id'], 'exist','targetClass' => 'app\models\goods\logs', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_logs');
        $obj->setData(['del'=>1]);
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }

}