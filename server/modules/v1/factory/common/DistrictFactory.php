<?php


namespace app\modules\v1\factory\common;


use app\modules\v1\factory\BaseFactory;

class DistrictFactory extends BaseFactory
{
    public $form_map = [

        'commondistrict.add'=>'app\modules\v1\forms\common\district\AddForm',
        'commondistrict.delete'=>'app\modules\v1\forms\common\district\DeleteForm',
        'commondistrict.update'=>'app\modules\v1\forms\common\district\UpdateForm',
        'commondistrict.getlist'=>'app\modules\v1\forms\common\district\GetListForm',
        'commondistrict.getall'=>'app\modules\v1\forms\common\district\GetAllForm',

    ];


}