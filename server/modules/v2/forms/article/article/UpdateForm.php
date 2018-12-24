<?php

namespace app\modules\v2\forms\article\article;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $article_id;
	public $dateline;
	public $title;
	public $content;
	public $view;
	


    public function addRule(){
       return [
           [["article_id","dateline","title","content","view"],'required','message'=>'{attribute}不能为空'],
           [['article_id'], 'exist','targetClass' => 'app\models\article\article', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('article_article');
        $obj->setData($form);
        $obj->setWhere(['article_id='=>$form->article_id]);
        return $obj->run();

    }
}