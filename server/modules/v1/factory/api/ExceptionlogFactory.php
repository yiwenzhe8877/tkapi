<?php

namespace app\modules\v1\factory\api;

use app\modules\v1\factory\BaseFactory;

class ExceptionlogFactory extends BaseFactory
{
    public $form_map = [
        'apiexceptionlog.delete'=>'app\modules\v1\forms\api\exceptionlog\DeleteForm',
        'apiexceptionlog.add'=>'app\modules\v1\forms\api\exceptionlog\AddForm',
        'apiexceptionlog.getlist'=>'app\modules\v1\forms\api\exceptionlog\GetListForm',
        'apiexceptionlog.update'=>'app\modules\v1\forms\api\exceptionlog\UpdateForm',
        'apiexceptionlog.getall'=>'app\modules\v1\forms\api\exceptionlog\GetAllForm',
    ];

}