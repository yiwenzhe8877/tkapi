<?php

namespace app\modules\v1\forms\admin\auth;


use app\models\AdminAuth;
use app\models\AdminGroup;
use app\models\AdminGroupAuth;
use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\auth\AuthService;
use app\componments\utils\ApiException;


class SyncGroupAuthForm extends CommonForm
{


    public function run(){

        return  AdminGroupApi::syncAuths();
    }


}