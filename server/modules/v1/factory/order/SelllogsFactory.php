<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class SelllogsFactory extends BaseFactory
{
    public $form_map = [
        'orderselllogs.delete'=>'app\modules\v1\forms\order\selllogs\DeleteForm',
        'orderselllogs.add'=>'app\modules\v1\forms\order\selllogs\AddForm',
        'orderselllogs.getlist'=>'app\modules\v1\forms\order\selllogs\GetListForm',
        'orderselllogs.update'=>'app\modules\v1\forms\order\selllogs\UpdateForm',
        'orderselllogs.getall'=>'app\modules\v1\forms\order\selllogs\GetAllForm',
    ];

}