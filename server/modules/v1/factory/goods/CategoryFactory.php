<?php


namespace app\modules\v1\factory\goods;


use app\modules\v1\factory\BaseFactory;

class CategoryFactory extends BaseFactory
{
    public $form_map = [

        'goodscategory.add'=>'app\modules\v1\forms\goods\category\AddForm',
        'goodscategory.delete'=>'app\modules\v1\forms\goods\category\DeleteForm',
        'goodscategory.update'=>'app\modules\v1\forms\goods\category\UpdateForm',
        'goodscategory.getlist'=>'app\modules\v1\forms\goods\category\GetListForm',
        'goodscategory.getall'=>'app\modules\v1\forms\goods\category\GetAllForm',

    ];


}