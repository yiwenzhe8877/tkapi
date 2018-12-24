<?php

namespace app\modules\v2\forms\order\tag;

use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $tag_id;

    public function addRule(){
        return [
            [['tag_id'],'required','message'=>'{attribute}不能为空'],
            [['tag_id'], 'exist','targetClass' => 'app\models\order\tag', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('order_tag');
        $obj->setWhere(['tag_id='=>$form->tag_id]);
        return $obj->run();

    }

}