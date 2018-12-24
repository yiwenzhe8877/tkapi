<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class GroupFactory extends BaseFactory
{
    public $form_map = [
        'storegroup.delete'=>'app\modules\v1\forms\store\group\DeleteForm',
        'storegroup.add'=>'app\modules\v1\forms\store\group\AddForm',
        'storegroup.getlist'=>'app\modules\v1\forms\store\group\GetListForm',
        'storegroup.update'=>'app\modules\v1\forms\store\group\UpdateForm',
        'storegroup.getall'=>'app\modules\v1\forms\store\group\GetAllForm',
    ];

}