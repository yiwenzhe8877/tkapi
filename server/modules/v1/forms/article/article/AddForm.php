<?php

namespace app\modules\v1\forms\article\article;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $dateline;
	public $title;
	public $content;
	public $view;
	


    public function addRule(){
        return [
            [["dateline","title","content","view"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('article_article');
        $obj->setData($form);
        return $obj->run();

    }
}