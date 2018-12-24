<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class PmtFactory extends BaseFactory
{
    public $form_map = [
        'orderpmt.delete'=>'app\modules\v1\forms\order\pmt\DeleteForm',
        'orderpmt.add'=>'app\modules\v1\forms\order\pmt\AddForm',
        'orderpmt.getlist'=>'app\modules\v1\forms\order\pmt\GetListForm',
        'orderpmt.update'=>'app\modules\v1\forms\order\pmt\UpdateForm',
        'orderpmt.getall'=>'app\modules\v1\forms\order\pmt\GetAllForm',
    ];

}