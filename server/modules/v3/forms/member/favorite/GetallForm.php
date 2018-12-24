<?php

namespace app\modules\v3\forms\member\favorite;



use app\componments\sql\SqlGet;
use app\componments\common\CommonForm;


class GetAllForm extends CommonForm
{
    public function addRule(){
        return [
        ];
    }

    public function run(){


        $obj=new SqlGet();
        $obj->setTableName('member_favorite');
        $obj->setOrderBy('id desc');
        $obj->setWhere( ['is_enabled='=>1]);

        return $obj->get_all();
    }

}