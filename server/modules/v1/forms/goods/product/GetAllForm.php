<?php

namespace app\modules\v1\forms\goods\product;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){


        $obj=new SqlGet();
        $obj->setTableName('goods_product');
        $obj->setOrderBy('sort desc');
        $obj->setWhere(['del='=>'0']);
        return $obj->get_all();
    }

}