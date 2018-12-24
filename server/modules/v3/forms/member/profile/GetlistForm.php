<?php

namespace app\modules\v3\forms\member\profile;



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
        $obj->setTableName('member_profile');
        $obj->setOrderBy('member_id desc');
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}