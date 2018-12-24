<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class BaseinfoFactory extends BaseFactory
{
    public $form_map = [
        'memberbaseinfo.delete'=>'app\modules\v1\forms\member\baseinfo\DeleteForm',
        'memberbaseinfo.add'=>'app\modules\v1\forms\member\baseinfo\AddForm',
        'memberbaseinfo.getlist'=>'app\modules\v1\forms\member\baseinfo\GetListForm',
        'memberbaseinfo.update'=>'app\modules\v1\forms\member\baseinfo\UpdateForm',
        'memberbaseinfo.getall'=>'app\modules\v1\forms\member\baseinfo\GetAllForm',
        'memberbaseinfo.xcxadd'=>'app\modules\v1\forms\member\baseinfo\XcxAddForm',
        'memberbaseinfo.xcxdecrptunionid'=>'app\modules\v1\forms\member\baseinfo\XcxDecrptUnionidForm',
        'memberbaseinfo.changepassword'=>'app\modules\v1\forms\member\baseinfo\ChangePasswordForm',
        'memberbaseinfo.changeriches'=>'app\modules\v1\forms\member\baseinfo\ChangeRichesForm',
    ];

}