<?php

namespace app\modules\v1\forms\article\article;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $page;
    public $type;


    public function addRule(){
        return [
            [['page','type'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('article');
        $obj->setOrderBy('article_id asc');
        $obj->setWhere(['author='=>$form->type]);
        $obj->setPageNum($form->page);

        return $obj->get_list();
    }

}