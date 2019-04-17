<?php

namespace app\modules\v1\forms\article\article;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetOneForm extends CommonForm
{

    public $id;


    public function addRule(){
        return [
            [['id'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('article');
        $obj->setOrderBy('article_id desc');
        $obj->setWhere(['article_id='=>$form->id]);
        $obj->setPageNum(1);
        $obj->setFields('FROM_UNIXTIME(dateline,\'%Y-%m-%d %H:%i:%s\') as dateline, wap_content,title');
        return $obj->get_list()['list'][0];
    }

}