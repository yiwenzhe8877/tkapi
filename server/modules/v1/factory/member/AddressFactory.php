<?php


namespace app\modules\v1\factory\member;


use app\modules\v1\factory\BaseFactory;

class AddressFactory extends BaseFactory
{
    public $form_map = [

        'memberaddress.add'=>'app\modules\v1\forms\member\address\AddForm',
        'memberaddress.delete'=>'app\modules\v1\forms\member\address\DeleteForm',
        'memberaddress.update'=>'app\modules\v1\forms\member\address\UpdateForm',
        'memberaddress.getlist'=>'app\modules\v1\forms\member\address\GetListForm',
        'memberaddress.getall'=>'app\modules\v1\forms\member\address\GetAllForm',

    ];


}