<?php

namespace app\modules\v1\factory\member;

use app\modules\v1\factory\BaseFactory;

class CommentFactory extends BaseFactory
{
    public $form_map = [
        'membercomment.delete'=>'app\modules\v1\forms\member\comment\DeleteForm',
        'membercomment.add'=>'app\modules\v1\forms\member\comment\AddForm',
        'membercomment.getlist'=>'app\modules\v1\forms\member\comment\GetListForm',
        'membercomment.update'=>'app\modules\v1\forms\member\comment\UpdateForm',
        'membercomment.getall'=>'app\modules\v1\forms\member\comment\GetAllForm',
    ];

}