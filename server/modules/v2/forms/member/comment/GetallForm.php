<?php

namespace app\modules\v2\forms\member\comment;



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
        $obj->setTableName('member_comment');
        $obj->setOrderBy('dis_id desc');
        $obj->setWhere( ['is_enabled='=>1]);

        return $obj->get_all();
    }

}