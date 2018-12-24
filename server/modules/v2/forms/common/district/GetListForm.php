<?php

namespace app\modules\v2\forms\common\district;




use app\componments\sql\SqlGet;
use app\modules\v2\forms\CommonForm;

class GetListForm extends CommonForm
{
    public $pageNum;



    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('goods_category');
        $obj->setOrderBy('classid desc');
        $obj->setWhere(['classtype='=>'industy']);
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();

    }

}