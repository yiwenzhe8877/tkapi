<?php

namespace app\modules\v2\forms\order\pmt;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $pmt_id;

    public function addRule(){
        return [
            [['pmt_id'],'required','message'=>'{attribute}不能为空'],
            [['pmt_id'], 'exist','targetClass' => 'app\models\order\pmt', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_pmt');
        $obj->setWhere(['pmt_id='=>$form->pmt_id]);
        return $obj->run();

    }

}