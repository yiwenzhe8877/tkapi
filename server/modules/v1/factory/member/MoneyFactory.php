<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class MoneyFactory extends BaseFactory
{
    public $form_map = [
        'membermoney.delete'=>'app\modules\v1\forms\member\money\DeleteForm',
        'membermoney.add'=>'app\modules\v1\forms\member\money\AddForm',
        'membermoney.getlist'=>'app\modules\v1\forms\member\money\GetListForm',
        'membermoney.update'=>'app\modules\v1\forms\member\money\UpdateForm',
        'membermoney.getall'=>'app\modules\v1\forms\member\money\GetAllForm',
    ];

}