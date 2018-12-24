<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class BaseFactory extends BaseFactory
{
    public $form_map = [
        'orderbase.delete'=>'app\modules\v1\forms\order\base\DeleteForm',
        'orderbase.add'=>'app\modules\v1\forms\order\base\AddForm',
        'orderbase.getlist'=>'app\modules\v1\forms\order\base\GetListForm',
        'orderbase.update'=>'app\modules\v1\forms\order\base\UpdateForm',
        'orderbase.getall'=>'app\modules\v1\forms\order\base\GetAllForm',
    ];

}