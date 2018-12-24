<?php

namespace app\modules\v1\factory\api;

use app\modules\v1\factory\BaseFactory;

class LogFactory extends BaseFactory
{
    public $form_map = [
        'apilog.delete'=>'app\modules\v1\forms\api\log\DeleteForm',
        'apilog.add'=>'app\modules\v1\forms\api\log\AddForm',
        'apilog.getlist'=>'app\modules\v1\forms\api\log\GetListForm',
        'apilog.update'=>'app\modules\v1\forms\api\log\UpdateForm',
        'apilog.getall'=>'app\modules\v1\forms\api\log\GetAllForm',
    ];

}