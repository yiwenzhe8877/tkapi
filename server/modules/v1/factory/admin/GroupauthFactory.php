<?php

namespace app\modules\v1\factory\admin;

use app\modules\v1\factory\BaseFactory;

class GroupauthFactory extends BaseFactory
{
    public $form_map = [
        'admingroupauth.delete'=>'app\modules\v1\forms\admin\groupauth\DeleteForm',
        'admingroupauth.add'=>'app\modules\v1\forms\admin\groupauth\AddForm',
        'admingroupauth.getlist'=>'app\modules\v1\forms\admin\groupauth\GetListForm',
        'admingroupauth.update'=>'app\modules\v1\forms\admin\groupauth\UpdateForm',
        'admingroupauth.getall'=>'app\modules\v1\forms\admin\groupauth\GetAllForm',
    ];

}