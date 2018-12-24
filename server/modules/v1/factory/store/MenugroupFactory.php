<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class MenugroupFactory extends BaseFactory
{
    public $form_map = [
        'storemenugroup.delete'=>'app\modules\v1\forms\store\menugroup\DeleteForm',
        'storemenugroup.add'=>'app\modules\v1\forms\store\menugroup\AddForm',
        'storemenugroup.getlist'=>'app\modules\v1\forms\store\menugroup\GetListForm',
        'storemenugroup.update'=>'app\modules\v1\forms\store\menugroup\UpdateForm',
        'storemenugroup.getall'=>'app\modules\v1\forms\store\menugroup\GetAllForm',
    ];

}