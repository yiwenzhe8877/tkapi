<?php
/**
 * Created by PhpStorm.
 * adminUser: idz025
 * DateUtils: 2018/11/2
 * Time: 10:23
 */

namespace app\modules\v1\factory\admin;


use app\modules\v1\factory\BaseFactory;

class OperatorLogsFactory extends BaseFactory
{
    public $form_map = [
        'adminoperatorlogs.delete'=>'app\modules\v1\forms\admin\operatorlogs\DeleteForm',
        'adminoperatorlogs.add'=>'app\modules\v1\forms\admin\operatorlogs\AddForm',
        'adminoperatorlogs.getlist'=>'app\modules\v1\forms\admin\operatorlogs\GetListForm',
        'adminoperatorlogs.getall'=>'app\modules\v1\forms\admin\operatorlogs\GetAllForm',
        'adminoperatorlogs.update'=>'app\modules\v1\forms\admin\operatorlogs\UpdateForm',

    ];

}