<?php

namespace app\modules\v1\factory\store;

use app\modules\v1\factory\BaseFactory;

class SettingFactory extends BaseFactory
{
    public $form_map = [
        'storesetting.delete'=>'app\modules\v1\forms\store\setting\DeleteForm',
        'storesetting.add'=>'app\modules\v1\forms\store\setting\AddForm',
        'storesetting.getlist'=>'app\modules\v1\forms\store\setting\GetListForm',
        'storesetting.update'=>'app\modules\v1\forms\store\setting\UpdateForm',
        'storesetting.getall'=>'app\modules\v1\forms\store\setting\GetAllForm',
    ];

}