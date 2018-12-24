<?php

namespace app\modules\v1\forms\goods\goods;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){


        $obj=new SqlGet();
        $obj->setTableName('goods_goods');
        $obj->setOrderBy('goods_id desc');
        return $obj->get_all();
    }

}