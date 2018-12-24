<?php

namespace app\modules\v3\forms\common\dlycorp;



use app\componments\sql\SqlGet;
use app\componments\common\CommonForm;

class GetListForm extends CommonForm
{

    public $pageNum;


    public function addRule(){
        return [
            [['pageNum'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('common_dlycorp');
        $obj->setOrderBy('corp_id desc');
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}