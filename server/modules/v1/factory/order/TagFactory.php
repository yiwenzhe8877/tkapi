<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class TagFactory extends BaseFactory
{
    public $form_map = [
        'ordertag.delete'=>'app\modules\v1\forms\order\tag\DeleteForm',
        'ordertag.add'=>'app\modules\v1\forms\order\tag\AddForm',
        'ordertag.getlist'=>'app\modules\v1\forms\order\tag\GetListForm',
        'ordertag.update'=>'app\modules\v1\forms\order\tag\UpdateForm',
        'ordertag.getall'=>'app\modules\v1\forms\order\tag\GetAllForm',
    ];

}