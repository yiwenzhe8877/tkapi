<?php

namespace app\modules\v1\factory\article;

use app\modules\v1\factory\BaseFactory;

class CategoryFactory extends BaseFactory
{
    public $form_map = [
        'articlecategory.delete'=>'app\modules\v1\forms\article\category\DeleteForm',
        'articlecategory.add'=>'app\modules\v1\forms\article\category\AddForm',
        'articlecategory.getlist'=>'app\modules\v1\forms\article\category\GetListForm',
        'articlecategory.update'=>'app\modules\v1\forms\article\category\UpdateForm',
        'articlecategory.getall'=>'app\modules\v1\forms\article\category\GetAllForm',
    ];

}