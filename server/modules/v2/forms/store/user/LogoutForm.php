<?php

namespace app\modules\v2\forms\store\user;

use app\models\api\store\user\StoreUserApi;
use app\models\store\user;
use app\modules\v2\forms\CommonForm;

class LogoutForm extends CommonForm
{


    public function run(){

        $uid=StoreUserApi::getLoginedUid();

        $model=user::findone($uid);

        $model->auth_key=1;
        $model->save();

        return "";
    }

}