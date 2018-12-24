<?php

namespace app\modules\v1\forms\order\deliveryitems;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

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
        $obj->setTableName('order_deliveryitems');
        $obj->setOrderBy('item_id desc');
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}