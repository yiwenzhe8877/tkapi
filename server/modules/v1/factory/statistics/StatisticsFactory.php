<?php

namespace app\modules\v1\factory\statistics;

use app\modules\v1\factory\BaseFactory;

class StatisticsFactory extends BaseFactory
{
    public $form_map = [
        'adminindex.statistics'=>'app\modules\v1\forms\statistics\index\GetForm',
    ];
}