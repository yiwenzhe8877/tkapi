<?php

namespace app\modules\v1\forms\admin\user;


use app\componments\sql\SqlGet;
use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\user\UserService;

class getAdminForm extends CommonForm
{


    public function run(){


        return [ GetLoginedAdminUserApi::getAllInfo()];

    }

}