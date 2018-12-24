<?php

namespace app\modules\v2\forms\admin\user;


use app\componments\sql\SqlGet;
use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\modules\v2\forms\CommonForm;
use app\modules\v2\service\user\UserService;

class getAdminForm extends CommonForm
{


    public function run(){


        return [ GetLoginedAdminUserApi::getAllInfo()];

    }

}