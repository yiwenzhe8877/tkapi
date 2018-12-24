<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class CartFactory extends BaseFactory
{
    public $form_map = [
        'membercart.delete'=>'app\modules\v1\forms\member\cart\DeleteForm',
        'membercart.add'=>'app\modules\v1\forms\member\cart\AddForm',
        'membercart.getlist'=>'app\modules\v1\forms\member\cart\GetListForm',
        'membercart.update'=>'app\modules\v1\forms\member\cart\UpdateForm',
        'membercart.getall'=>'app\modules\v1\forms\member\cart\GetAllForm',
    ];

}