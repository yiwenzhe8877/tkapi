<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class VerifyFactory extends BaseFactory
{
    public $form_map = [
        'memberverify.delete'=>'app\modules\v1\forms\member\verify\DeleteForm',
        'memberverify.add'=>'app\modules\v1\forms\member\verify\AddForm',
        'memberverify.getlist'=>'app\modules\v1\forms\member\verify\GetListForm',
        'memberverify.update'=>'app\modules\v1\forms\member\verify\UpdateForm',
        'memberverify.getall'=>'app\modules\v1\forms\member\verify\GetAllForm',
    ];

}