<?php

namespace app\modules\v2\forms\member\consult;



use app\componments\sql\SqlGet;
use app\modules\v2\forms\CommonForm;

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
        $obj->setTableName('member_consult');
        $obj->setOrderBy('con_id desc');
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}