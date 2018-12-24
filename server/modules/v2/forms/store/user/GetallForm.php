<?php

namespace app\modules\v2\forms\store\user;



use app\componments\sql\SqlGet;
use app\modules\v2\forms\CommonForm;


class GetAllForm extends CommonForm
{
    public function addRule(){
        return [
        ];
    }

    public function run(){


        $obj=new SqlGet();
        $obj->setTableName('store_user');
        $obj->setOrderBy('group_id desc');
        $obj->setWhere( ['is_enabled='=>1]);

        return $obj->get_all();
    }

}