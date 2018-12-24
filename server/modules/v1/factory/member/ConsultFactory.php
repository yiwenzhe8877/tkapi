<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class ConsultFactory extends BaseFactory
{
    public $form_map = [
        'memberconsult.delete'=>'app\modules\v1\forms\member\consult\DeleteForm',
        'memberconsult.add'=>'app\modules\v1\forms\member\consult\AddForm',
        'memberconsult.getlist'=>'app\modules\v1\forms\member\consult\GetListForm',
        'memberconsult.update'=>'app\modules\v1\forms\member\consult\UpdateForm',
        'memberconsult.getall'=>'app\modules\v1\forms\member\consult\GetAllForm',
    ];

}