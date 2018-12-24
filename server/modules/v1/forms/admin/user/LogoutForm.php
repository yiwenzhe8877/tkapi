<?php

namespace app\modules\v1\forms\admin\user;

use app\models\admin\user;
use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\modules\v1\forms\CommonForm;

class LogoutForm extends CommonForm
{


    public function run(){

        $uid=GetLoginedAdminUserApi::getUid();

        if(!YII_DEBUG){

            $model=user::findone($uid);

            $model->auth_key=getRandom();
            $model->save();
        }

        return "";
    }

}