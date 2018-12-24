<?php

namespace app\modules\v3\forms\goods\goods;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $goods_id;

    public function addRule(){
        return [
            [['goods_id'],'required','message'=>'{attribute}不能为空'],
            [['goods_id'], 'exist','targetClass' => 'app\models\goods\goods', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_goods');
        $obj->setWhere(['goods_id='=>$form->goods_id]);
        return $obj->run();

    }

}