<?php


namespace app\modules\v1\factory\goods;


use app\modules\v1\factory\BaseFactory;

class LogsFactory extends BaseFactory
{
    public $form_map = [

        'goodslogs.add'=>'app\modules\v1\forms\goods\logs\AddForm',
        'goodslogs.delete'=>'app\modules\v1\forms\goods\logs\DeleteForm',
        'goodslogs.update'=>'app\modules\v1\forms\goods\logs\UpdateForm',
        'goodslogs.getlist'=>'app\modules\v1\forms\goods\logs\GetListForm',
        'goodslogs.getall'=>'app\modules\v1\forms\goods\logs\GetAllForm',

    ];


}