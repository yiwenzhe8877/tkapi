<?php
namespace app\modules\v1\factory\member;



use app\modules\v1\factory\BaseFactory;

class GroupFactory extends BaseFactory
{
    public $form_map = [

        'membergroup.add'=>'app\modules\v1\forms\member\group\AddForm',
        'membergroup.delete'=>'app\modules\v1\forms\member\group\DeleteForm',
        'membergroup.update'=>'app\modules\v1\forms\member\group\UpdateForm',
        'membergroup.getlist'=>'app\modules\v1\forms\member\group\GetListForm',
        'membergroup.getall'=>'app\modules\v1\forms\member\group\GetAllForm',
        'membergroup.setdefault'=>'app\modules\v1\forms\member\group\SetDefaultForm',


    ];


}