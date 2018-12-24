<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class MenuFactory extends BaseFactory
{
    public $form_map = [
        'storemenu.delete'=>'app\modules\v1\forms\store\menu\DeleteForm',
        'storemenu.add'=>'app\modules\v1\forms\store\menu\AddForm',
        'storemenu.getlist'=>'app\modules\v1\forms\store\menu\GetListForm',
        'storemenu.update'=>'app\modules\v1\forms\store\menu\UpdateForm',
        'storemenu.getall'=>'app\modules\v1\forms\store\menu\GetAllForm',
    ];

}