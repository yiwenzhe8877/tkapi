<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class PaymentsFactory extends BaseFactory
{
    public $form_map = [
        'orderpayments.delete'=>'app\modules\v1\forms\order\payments\DeleteForm',
        'orderpayments.add'=>'app\modules\v1\forms\order\payments\AddForm',
        'orderpayments.getlist'=>'app\modules\v1\forms\order\payments\GetListForm',
        'orderpayments.update'=>'app\modules\v1\forms\order\payments\UpdateForm',
        'orderpayments.getall'=>'app\modules\v1\forms\order\payments\GetAllForm',
    ];

}