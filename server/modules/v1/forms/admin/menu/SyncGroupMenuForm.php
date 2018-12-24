<?php

namespace app\modules\v1\forms\admin\menu;


use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;

class SyncGroupMenuForm extends CommonForm
{

    public function run(){

      return AdminGroupApi::syncMenu();
    }


}