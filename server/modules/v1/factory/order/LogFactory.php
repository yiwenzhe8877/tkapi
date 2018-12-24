<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class LogFactory extends BaseFactory
{
    public $form_map = [
        'orderlog.delete'=>'app\modules\v1\forms\order\log\DeleteForm',
        'orderlog.add'=>'app\modules\v1\forms\order\log\AddForm',
        'orderlog.getlist'=>'app\modules\v1\forms\order\log\GetListForm',
        'orderlog.update'=>'app\modules\v1\forms\order\log\UpdateForm',
        'orderlog.getall'=>'app\modules\v1\forms\order\log\GetAllForm',
    ];

}