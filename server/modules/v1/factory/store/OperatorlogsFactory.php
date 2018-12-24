<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class OperatorlogsFactory extends BaseFactory
{
    public $form_map = [
        'storeoperatorlogs.delete'=>'app\modules\v1\forms\store\operatorlogs\DeleteForm',
        'storeoperatorlogs.add'=>'app\modules\v1\forms\store\operatorlogs\AddForm',
        'storeoperatorlogs.getlist'=>'app\modules\v1\forms\store\operatorlogs\GetListForm',
        'storeoperatorlogs.update'=>'app\modules\v1\forms\store\operatorlogs\UpdateForm',
        'storeoperatorlogs.getall'=>'app\modules\v1\forms\store\operatorlogs\GetAllForm',
    ];

}