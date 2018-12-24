<?php

namespace app\modules\v3\forms\goods\logs;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $log_id;

    public function addRule(){
        return [
            [['log_id'],'required','message'=>'{attribute}不能为空'],
            [['log_id'], 'exist','targetClass' => 'app\models\goods\logs', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_logs');
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }

}