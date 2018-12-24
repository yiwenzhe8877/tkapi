<?php
/**
 * Created by PhpStorm.
 * adminUser: idz025
 * DateUtils: 2018/11/2
 * Time: 10:23
 */

namespace app\modules\v1\factory\admin;


use app\modules\v1\factory\BaseFactory;

class AuthFactory extends BaseFactory
{
    public $form_map = [
        'adminauth.delete'=>'app\modules\v1\forms\admin\auth\DeleteForm',
        'adminauth.add'=>'app\modules\v1\forms\admin\auth\AddForm',
        'adminauth.getlist'=>'app\modules\v1\forms\admin\auth\GetListForm',
        'adminauth.update'=>'app\modules\v1\forms\admin\auth\UpdateForm',
        'adminauth.setgroupauth'=>'app\modules\v1\forms\admin\auth\SetGroupAuthForm',
        'adminauth.syncgroupauth'=>'app\modules\v1\forms\admin\auth\SyncGroupAuthForm',
        'adminauth.getgroupauthlist'=>'app\modules\v1\forms\admin\auth\GetGroupAuthListForm',

    ];


}