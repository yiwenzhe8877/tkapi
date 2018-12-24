<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class RefundsFactory extends BaseFactory
{
    public $form_map = [
        'orderrefunds.delete'=>'app\modules\v1\forms\order\refunds\DeleteForm',
        'orderrefunds.add'=>'app\modules\v1\forms\order\refunds\AddForm',
        'orderrefunds.getlist'=>'app\modules\v1\forms\order\refunds\GetListForm',
        'orderrefunds.update'=>'app\modules\v1\forms\order\refunds\UpdateForm',
        'orderrefunds.getall'=>'app\modules\v1\forms\order\refunds\GetAllForm',
    ];

}