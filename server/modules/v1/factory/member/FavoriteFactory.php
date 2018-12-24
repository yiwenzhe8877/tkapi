<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class FavoriteFactory extends BaseFactory
{
    public $form_map = [
        'memberfavorite.delete'=>'app\modules\v1\forms\member\favorite\DeleteForm',
        'memberfavorite.add'=>'app\modules\v1\forms\member\favorite\AddForm',
        'memberfavorite.getlist'=>'app\modules\v1\forms\member\favorite\GetListForm',
        'memberfavorite.update'=>'app\modules\v1\forms\member\favorite\UpdateForm',
        'memberfavorite.getall'=>'app\modules\v1\forms\member\favorite\GetAllForm',
    ];

}