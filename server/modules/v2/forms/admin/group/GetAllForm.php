<?php

namespace app\modules\v1\forms\admin\group;


use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{






    public function run(){
        $obj=new SqlGet();
        $obj->setTableName('admin_group');
        $obj->setOrderBy('group_id desc');
        return $obj->get_all();


    }

}