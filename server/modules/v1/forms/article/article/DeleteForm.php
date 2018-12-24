<?php

namespace app\modules\v1\forms\article\article;

use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $article_id;

    public function addRule(){
        return [
            [['article_id'],'required','message'=>'{attribute}不能为空'],
            [['article_id'], 'exist','targetClass' => 'app\models\article\article', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('article_article');
        $obj->setWhere(['article_id='=>$form->article_id]);
        return $obj->run();

    }

}