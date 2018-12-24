<?php

namespace app\modules\v1\factory\article;

use app\modules\v1\factory\BaseFactory;

class ArticleFactory extends BaseFactory
{
    public $form_map = [
        'articlearticle.delete'=>'app\modules\v1\forms\article\article\DeleteForm',
        'articlearticle.add'=>'app\modules\v1\forms\article\article\AddForm',
        'articlearticle.getlist'=>'app\modules\v1\forms\article\article\GetListForm',
        'articlearticle.update'=>'app\modules\v1\forms\article\article\UpdateForm',
        'articlearticle.getall'=>'app\modules\v1\forms\article\article\GetAllForm',
    ];

}