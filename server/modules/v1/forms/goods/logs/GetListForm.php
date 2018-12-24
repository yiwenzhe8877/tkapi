<?php

namespace app\modules\v1\forms\goods\product;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{
    public $pageNum;



    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('goods_logs');
        $obj->setOrderBy('log_id desc');
        $obj->setWhere(['del='=>'0']);
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();

    }

}