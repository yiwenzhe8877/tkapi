<?php

namespace app\modules\v2\forms\member\address;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $addr_id;

    public function addRule(){
        return [
            [['addr_id'],'required','message'=>'{attribute}不能为空'],
            [['addr_id'], 'exist','targetClass' => 'app\models\member\address', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('member_address');
        $obj->setWhere(['addr_id='=>$form->addr_id]);
        return $obj->run();

    }

}