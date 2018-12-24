<?php


namespace app\modules\v1\factory\goods;


use app\modules\v1\factory\BaseFactory;

class GoodsFactory extends BaseFactory
{
    public $form_map = [

        'goodsgoods.add'=>'app\modules\v1\forms\goods\goods\AddForm',
        'goodsgoods.delete'=>'app\modules\v1\forms\goods\goods\DeleteForm',
        'goodsgoods.update'=>'app\modules\v1\forms\goods\goods\UpdateForm',
        'goodsgoods.getlist'=>'app\modules\v1\forms\goods\goods\GetListForm',
        'goodsgoods.getall'=>'app\modules\v1\forms\goods\goods\GetAllForm',

    ];


}