<?php

namespace app\modules\v2\forms\admin\user;

use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\models\api\store\user\StoreUserApi;
use app\models\store\user;
use app\modules\v2\forms\CommonForm;

class LogoutForm extends CommonForm
{


    public function run(){
        return 32;
        /*$uid=StoreUserApi::getUid();
        p($uid);
        return;
        $model=user::findone($uid);

        $model->auth_key=getRandom();
        $model->save();
        return "";*/
    }

}