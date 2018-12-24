<?php

namespace app\modules\v3\forms\goods\category;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $classid;

    public function addRule(){
        return [
            [['classid'],'required','message'=>'{attribute}不能为空'],
            [['classid'], 'exist','targetClass' => 'app\models\goods\category', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_category');
        $obj->setWhere(['classid='=>$form->classid]);
        return $obj->run();

    }

}