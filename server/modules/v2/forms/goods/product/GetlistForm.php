<?php

namespace app\modules\v1\forms\goods\product;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{
    public $pageNum;



    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('goods_product');
        $obj->setOrderBy('product_id desc');
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();

    }

}