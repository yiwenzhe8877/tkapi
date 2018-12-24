<?php

namespace app\modules\v1\factory\order;

use app\modules\v1\factory\BaseFactory;

class DownloadlogFactory extends BaseFactory
{
    public $form_map = [
        'orderdownloadlog.delete'=>'app\modules\v1\forms\order\downloadlog\DeleteForm',
        'orderdownloadlog.add'=>'app\modules\v1\forms\order\downloadlog\AddForm',
        'orderdownloadlog.getlist'=>'app\modules\v1\forms\order\downloadlog\GetListForm',
        'orderdownloadlog.update'=>'app\modules\v1\forms\order\downloadlog\UpdateForm',
        'orderdownloadlog.getall'=>'app\modules\v1\forms\order\downloadlog\GetAllForm',
    ];

}