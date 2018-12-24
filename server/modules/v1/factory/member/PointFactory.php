<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class PointFactory extends BaseFactory
{
    public $form_map = [
        'memberpoint.delete'=>'app\modules\v1\forms\member\point\DeleteForm',
        'memberpoint.add'=>'app\modules\v1\forms\member\point\AddForm',
        'memberpoint.getlist'=>'app\modules\v1\forms\member\point\GetListForm',
        'memberpoint.update'=>'app\modules\v1\forms\member\point\UpdateForm',
        'memberpoint.getall'=>'app\modules\v1\forms\member\point\GetAllForm',
    ];

}