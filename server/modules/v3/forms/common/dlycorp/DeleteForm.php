<?php

namespace app\modules\v3\forms\common\dlycorp;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $corp_id;

    public function addRule(){
        return [
            [['corp_id'],'required','message'=>'{attribute}不能为空'],
            [['corp_id'], 'exist','targetClass' => 'app\models\common\dlycorp', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('common_dlycorp');
        $obj->setWhere(['corp_id='=>$form->corp_id]);
        return $obj->run();

    }

}