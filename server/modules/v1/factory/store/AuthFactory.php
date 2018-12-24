<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class AuthFactory extends BaseFactory
{
    public $form_map = [
        'storeauth.delete'=>'app\modules\v1\forms\store\auth\DeleteForm',
        'storeauth.add'=>'app\modules\v1\forms\store\auth\AddForm',
        'storeauth.getlist'=>'app\modules\v1\forms\store\auth\GetListForm',
        'storeauth.update'=>'app\modules\v1\forms\store\auth\UpdateForm',
        'storeauth.getall'=>'app\modules\v1\forms\store\auth\GetAllForm',
    ];

}