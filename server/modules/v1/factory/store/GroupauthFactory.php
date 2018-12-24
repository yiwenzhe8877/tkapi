<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class GroupauthFactory extends BaseFactory
{
    public $form_map = [
        'storegroupauth.delete'=>'app\modules\v1\forms\store\groupauth\DeleteForm',
        'storegroupauth.add'=>'app\modules\v1\forms\store\groupauth\AddForm',
        'storegroupauth.getlist'=>'app\modules\v1\forms\store\groupauth\GetListForm',
        'storegroupauth.update'=>'app\modules\v1\forms\store\groupauth\UpdateForm',
        'storegroupauth.getall'=>'app\modules\v1\forms\store\groupauth\GetAllForm',
    ];

}