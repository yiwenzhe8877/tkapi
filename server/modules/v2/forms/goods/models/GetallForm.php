<?php

namespace app\modules\v1\forms\goods\category;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){

        return [1];
        $obj=new SqlGet();
        $obj->setTableName('goods_models');
        $obj->setOrderBy('sort desc');
        return $obj->get_all();
    }

}