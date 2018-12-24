<?php

namespace app\modules\v2\forms\order\selllogs;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $log_id;

    public function addRule(){
        return [
            [['log_id'],'required','message'=>'{attribute}不能为空'],
            [['log_id'], 'exist','targetClass' => 'app\models\order\selllogs', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_selllogs');
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }

}