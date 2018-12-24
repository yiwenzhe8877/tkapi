<?php

namespace app\modules\v2\forms\article\category;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $category_id;
	


    public function addRule(){
        return [
            [["category_id"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('article_category');
        $obj->setData($form);
        return $obj->run();

    }
}