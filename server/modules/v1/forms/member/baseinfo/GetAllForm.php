<?php

namespace app\modules\v1\forms\member\baseinfo;




use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;


class GetAllForm extends CommonForm
{




    public function run(){


        $obj=new SqlGet();
        $obj->setTableName('member_baseinfo');
        $obj->setOrderBy('member_id desc');
        return $obj->get_all();
    }

}