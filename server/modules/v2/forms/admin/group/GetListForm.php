<?php

namespace app\modules\v1\forms\admin\group;


use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{
    public $pageNum;


    public function rules()
    {
        return [
            [['pageNum'],'required','message'=>'{attribute}不能为空'],
        ];

    }



    public function run($form){


        $obj=new SqlGet();
        $obj->setTableName('admin_group');
        $obj->setOrderBy('group_id desc');
        $obj->setPageNum($form->pageNum);

        return $obj->get_list();


    }

}