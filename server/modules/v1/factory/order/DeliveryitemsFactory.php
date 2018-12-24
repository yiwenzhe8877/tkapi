<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class DeliveryitemsFactory extends BaseFactory
{
    public $form_map = [
        'orderdeliveryitems.delete'=>'app\modules\v1\forms\order\deliveryitems\DeleteForm',
        'orderdeliveryitems.add'=>'app\modules\v1\forms\order\deliveryitems\AddForm',
        'orderdeliveryitems.getlist'=>'app\modules\v1\forms\order\deliveryitems\GetListForm',
        'orderdeliveryitems.update'=>'app\modules\v1\forms\order\deliveryitems\UpdateForm',
        'orderdeliveryitems.getall'=>'app\modules\v1\forms\order\deliveryitems\GetAllForm',
    ];

}