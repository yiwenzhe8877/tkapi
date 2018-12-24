<?php

namespace app\modules\v1\factory\admin;

use app\modules\v1\factory\BaseFactory;

class UserFactory extends BaseFactory
{
    public $form_map = [
        'adminuser.delete'=>'app\modules\v1\forms\admin\user\DeleteForm',
        'adminuser.add'=>'app\modules\v1\forms\admin\user\AddForm',
        'adminuser.login'=>'app\modules\v1\forms\admin\user\LoginForm',
        'adminuser.logout'=>'app\modules\v1\forms\admin\user\LogoutForm',
        'adminuser.getone'=>'app\modules\v1\forms\admin\user\GetOneForm',
        'adminuser.getadmin'=>'app\modules\v1\forms\admin\user\GetAdminForm',
        'adminuser.getlist'=>'app\modules\v1\forms\admin\user\GetListForm',
        'adminuser.update'=>'app\modules\v1\forms\admin\user\UpdateForm',
        'adminuser.changepassword'=>'app\modules\v1\forms\admin\user\ChangePasswordForm',

    ];

   
}