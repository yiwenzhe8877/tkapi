<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class UserFactory extends BaseFactory
{
    public $form_map = [
        'storeuser.delete'=>'app\modules\v1\forms\store\user\DeleteForm',
        'storeuser.add'=>'app\modules\v1\forms\store\user\AddForm',
        'storeuser.getlist'=>'app\modules\v1\forms\store\user\GetListForm',
        'storeuser.update'=>'app\modules\v1\forms\store\user\UpdateForm',
        'storeuser.getall'=>'app\modules\v1\forms\store\user\GetAllForm',
    ];

}