<?php

namespace app\modules\v1\factory\freight;

use app\modules\v1\factory\BaseFactory;

class TemplateFactory extends BaseFactory
{
    public $form_map = [
        'freighttemplate.delete'=>'app\modules\v1\forms\freight\template\DeleteForm',
        'freighttemplate.add'=>'app\modules\v1\forms\freight\template\AddForm',
        'freighttemplate.getlist'=>'app\modules\v1\forms\freight\template\GetListForm',
        'freighttemplate.update'=>'app\modules\v1\forms\freight\template\UpdateForm',
        'freighttemplate.getall'=>'app\modules\v1\forms\freight\template\GetAllForm',
    ];

}