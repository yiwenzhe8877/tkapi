<?php

namespace app\modules\v1\forms\admin\menu;


use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\sql\sqlService;


class GetAllForm extends CommonForm
{




    public function run(){

        $obj=new SqlGet();
        $obj->setTableName('admin_menu');
        $obj->setOrderBy('sort desc');
        return $obj->get_all();


    }

}