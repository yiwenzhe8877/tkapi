<?php

namespace app\modules\v1\forms\admin\auth;




use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{






    public function run(){


        $obj=new SqlGet();
        $obj->setTableName('admin_auth');
        $obj->setOrderBy('auth_id desc');
        return $obj->get_all();


    }

}