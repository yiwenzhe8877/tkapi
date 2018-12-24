<?php


namespace app\modules\v1\factory\goods;


use app\modules\v1\factory\BaseFactory;

class ProductFactory extends BaseFactory
{
    public $form_map = [

        'goodsproduct.add'=>'app\modules\v1\forms\goods\product\AddForm',
        'goodsproduct.delete'=>'app\modules\v1\forms\goods\product\DeleteForm',
        'goodsproduct.update'=>'app\modules\v1\forms\goods\product\UpdateForm',
        'goodsproduct.getlist'=>'app\modules\v1\forms\goods\product\GetListForm',
        'goodsproduct.getall'=>'app\modules\v1\forms\goods\product\GetAllForm',

    ];


}