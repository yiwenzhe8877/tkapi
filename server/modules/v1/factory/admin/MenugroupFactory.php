<?php

namespace app\modules\v1\factory\admin;

use app\modules\v1\factory\BaseFactory;

class MenugroupFactory extends BaseFactory
{
    public $form_map = [
        'adminmenugroup.delete'=>'app\modules\v1\forms\admin\menugroup\DeleteForm',
        'adminmenugroup.add'=>'app\modules\v1\forms\admin\menugroup\AddForm',
        'adminmenugroup.getlist'=>'app\modules\v1\forms\admin\menugroup\GetListForm',
        'adminmenugroup.update'=>'app\modules\v1\forms\admin\menugroup\UpdateForm',
        'adminmenugroup.getall'=>'app\modules\v1\forms\admin\menugroup\GetAllForm',
    ];

}