<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class ItemsFactory extends BaseFactory
{
    public $form_map = [
        'orderitems.delete'=>'app\modules\v1\forms\order\items\DeleteForm',
        'orderitems.add'=>'app\modules\v1\forms\order\items\AddForm',
        'orderitems.getlist'=>'app\modules\v1\forms\order\items\GetListForm',
        'orderitems.update'=>'app\modules\v1\forms\order\items\UpdateForm',
        'orderitems.getall'=>'app\modules\v1\forms\order\items\GetAllForm',
    ];

}