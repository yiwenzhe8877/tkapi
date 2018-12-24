<?php

namespace app\modules\v1\forms\admin\menu;


use app\models\api\admin\group\AdminGroupApi;
use app\models\api\admin\user\GetAdminUserApi;
use app\models\api\admin\user\GetLoginedAdminUserApi;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\menu\MenuService;

class GetMenuGroupRelationForm extends CommonForm
{



    public function run(){

        return AdminGroupApi::getGroupMenus(GetLoginedAdminUserApi::getGroupId());

    }

}