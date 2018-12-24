<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class SysmsgFactory extends BaseFactory
{
    public $form_map = [
        'membersysmsg.delete'=>'app\modules\v1\forms\member\sysmsg\DeleteForm',
        'membersysmsg.add'=>'app\modules\v1\forms\member\sysmsg\AddForm',
        'membersysmsg.getlist'=>'app\modules\v1\forms\member\sysmsg\GetListForm',
        'membersysmsg.update'=>'app\modules\v1\forms\member\sysmsg\UpdateForm',
        'membersysmsg.getall'=>'app\modules\v1\forms\member\sysmsg\GetAllForm',
    ];

}