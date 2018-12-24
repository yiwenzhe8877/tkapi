<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class StoreFactory extends BaseFactory
{
    public $form_map = [
        'storestore.delete'=>'app\modules\v1\forms\store\store\DeleteForm',
        'storestore.add'=>'app\modules\v1\forms\store\store\AddForm',
        'storestore.getlist'=>'app\modules\v1\forms\store\store\GetListForm',
        'storestore.update'=>'app\modules\v1\forms\store\store\UpdateForm',
        'storestore.getall'=>'app\modules\v1\forms\store\store\GetAllForm',
    ];

}