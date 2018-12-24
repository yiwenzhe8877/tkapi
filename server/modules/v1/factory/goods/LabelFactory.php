<?php

namespace app\modules\v1\factory\goods;

use app\modules\v1\factory\BaseFactory;

class LabelFactory extends BaseFactory
{
    public $form_map = [
        'goodslabel.delete'=>'app\modules\v1\forms\goods\label\DeleteForm',
        'goodslabel.add'=>'app\modules\v1\forms\goods\label\AddForm',
        'goodslabel.getlist'=>'app\modules\v1\forms\goods\label\GetListForm',
        'goodslabel.update'=>'app\modules\v1\forms\goods\label\UpdateForm',
        'goodslabel.getall'=>'app\modules\v1\forms\goods\label\GetAllForm',
    ];

}