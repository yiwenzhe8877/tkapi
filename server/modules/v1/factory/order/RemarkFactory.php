<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class RemarkFactory extends BaseFactory
{
    public $form_map = [
        'orderremark.delete'=>'app\modules\v1\forms\order\remark\DeleteForm',
        'orderremark.add'=>'app\modules\v1\forms\order\remark\AddForm',
        'orderremark.getlist'=>'app\modules\v1\forms\order\remark\GetListForm',
        'orderremark.update'=>'app\modules\v1\forms\order\remark\UpdateForm',
        'orderremark.getall'=>'app\modules\v1\forms\order\remark\GetAllForm',
    ];

}