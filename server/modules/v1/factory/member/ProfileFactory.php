<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class ProfileFactory extends BaseFactory
{
    public $form_map = [
        'memberprofile.delete'=>'app\modules\v1\forms\member\profile\DeleteForm',
        'memberprofile.add'=>'app\modules\v1\forms\member\profile\AddForm',
        'memberprofile.getlist'=>'app\modules\v1\forms\member\profile\GetListForm',
        'memberprofile.update'=>'app\modules\v1\forms\member\profile\UpdateForm',
        'memberprofile.getall'=>'app\modules\v1\forms\member\profile\GetAllForm',
    ];

}