<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class FootprintFactory extends BaseFactory
{
    public $form_map = [
        'memberfootprint.delete'=>'app\modules\v1\forms\member\footprint\DeleteForm',
        'memberfootprint.add'=>'app\modules\v1\forms\member\footprint\AddForm',
        'memberfootprint.getlist'=>'app\modules\v1\forms\member\footprint\GetListForm',
        'memberfootprint.update'=>'app\modules\v1\forms\member\footprint\UpdateForm',
        'memberfootprint.getall'=>'app\modules\v1\forms\member\footprint\GetAllForm',
    ];

}