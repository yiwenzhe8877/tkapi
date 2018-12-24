<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class LoginlogFactory extends BaseFactory
{
    public $form_map = [
        'memberloginlog.delete'=>'app\modules\v1\forms\member\loginlog\DeleteForm',
        'memberloginlog.add'=>'app\modules\v1\forms\member\loginlog\AddForm',
        'memberloginlog.getlist'=>'app\modules\v1\forms\member\loginlog\GetListForm',
        'memberloginlog.update'=>'app\modules\v1\forms\member\loginlog\UpdateForm',
        'memberloginlog.getall'=>'app\modules\v1\forms\member\loginlog\GetAllForm',
    ];

}