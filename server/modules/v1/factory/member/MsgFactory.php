<?php


namespace app\modules\v1\factory\member;



use app\modules\v1\factory\BaseFactory;

class MsgFactory extends BaseFactory
{
    public $form_map = [

        'membermsg.add'=>'app\modules\v1\forms\member\msg\AddForm',
        'membermsg.delete'=>'app\modules\v1\forms\member\msg\DeleteForm',
        'membermsg.update'=>'app\modules\v1\forms\member\msg\UpdateForm',
        'membermsg.getlist'=>'app\modules\v1\forms\member\msg\GetListForm',
        'membermsg.getall'=>'app\modules\v1\forms\member\msg\GetAllForm',
        'membermsg.changepassword'=>'app\modules\v1\forms\member\msg\ChangePasswordForm',
        'membermsg.changeriches'=>'app\modules\v1\forms\member\msg\ChangeRichesForm',
        'membermsg.setread'=>'app\modules\v1\forms\member\msg\SetReadForm',

    ];


}