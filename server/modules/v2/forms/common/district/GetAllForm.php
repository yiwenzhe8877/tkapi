<?php

namespace app\modules\v2\forms\common\district;




use app\componments\sql\SqlGet;
use app\modules\v2\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){


        $obj=new SqlGet();
        $obj->setTableName('goods_category');
        $obj->setOrderBy('displayorder asc');
        $obj->setWhere( ['classtype='=>"industy",' and upid='=>$form->pid]);
        return $obj->get_all();
    }

}