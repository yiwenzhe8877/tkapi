<?php


namespace app\modules\v1\factory\common;


use app\modules\v1\factory\BaseFactory;

class DlycorpFactory extends BaseFactory
{
    public $form_map = [

        'commondlycorp.add'=>'app\modules\v1\forms\common\dlycorp\AddForm',
        'commondlycorp.delete'=>'app\modules\v1\forms\common\dlycorp\DeleteForm',
        'commondlycorp.update'=>'app\modules\v1\forms\common\dlycorp\UpdateForm',
        'commondlycorp.getlist'=>'app\modules\v1\forms\common\dlycorp\GetListForm',
        'commondlycorp.getall'=>'app\modules\v1\forms\common\dlycorp\GetAllForm',

    ];


}