<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class DeliveryFactory extends BaseFactory
{
    public $form_map = [
        'orderdelivery.delete'=>'app\modules\v1\forms\order\delivery\DeleteForm',
        'orderdelivery.add'=>'app\modules\v1\forms\order\delivery\AddForm',
        'orderdelivery.getlist'=>'app\modules\v1\forms\order\delivery\GetListForm',
        'orderdelivery.update'=>'app\modules\v1\forms\order\delivery\UpdateForm',
        'orderdelivery.getall'=>'app\modules\v1\forms\order\delivery\GetAllForm',
    ];

}