<?php

namespace app\modules\v3\forms\article\category;

use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;

class DeleteForm extends CommonForm
{
    public $article_id;

    public function addRule(){
        return [
            [['article_id'],'required','message'=>'{attribute}不能为空'],
            [['article_id'], 'exist','targetClass' => 'app\models\article\category', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('article_category');
        $obj->setWhere(['article_id='=>$form->article_id]);
        return $obj->run();

    }

}