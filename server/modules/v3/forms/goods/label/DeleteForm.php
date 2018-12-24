<?php

namespace app\modules\v3\forms\goods\label;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $label_id;

    public function addRule(){
        return [
            [['label_id'],'required','message'=>'{attribute}不能为空'],
            [['label_id'], 'exist','targetClass' => 'app\models\goods\label', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_label');
        $obj->setWhere(['label_id='=>$form->label_id]);
        return $obj->run();

    }

}