<?php

namespace app\modules\v1\factory\apitest;

use app\modules\v1\factory\BaseFactory;

class UsercaseFactory extends BaseFactory
{
    public $form_map = [
        'apitestusercase.delete'=>'app\modules\v1\forms\apitest\usercase\DeleteForm',
        'apitestusercase.add'=>'app\modules\v1\forms\apitest\usercase\AddForm',
        'apitestusercase.getlist'=>'app\modules\v1\forms\apitest\usercase\GetListForm',
        'apitestusercase.update'=>'app\modules\v1\forms\apitest\usercase\UpdateForm',
        'apitestusercase.getall'=>'app\modules\v1\forms\apitest\usercase\GetAllForm',
    ];

}