<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class EvaluatFactory extends BaseFactory
{
    public $form_map = [
        'memberevaluat.delete'=>'app\modules\v1\forms\member\evaluat\DeleteForm',
        'memberevaluat.add'=>'app\modules\v1\forms\member\evaluat\AddForm',
        'memberevaluat.getlist'=>'app\modules\v1\forms\member\evaluat\GetListForm',
        'memberevaluat.update'=>'app\modules\v1\forms\member\evaluat\UpdateForm',
        'memberevaluat.getall'=>'app\modules\v1\forms\member\evaluat\GetAllForm',
    ];

}