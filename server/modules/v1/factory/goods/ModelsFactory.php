<?php


namespace app\modules\v1\factory\goods;


use app\modules\v1\factory\BaseFactory;

class ModelsFactory extends BaseFactory
{
    public $form_map = [

        'goodsmodels.add'=>'app\modules\v1\forms\goods\models\AddForm',
        'goodsmodels.delete'=>'app\modules\v1\forms\goods\models\DeleteForm',
        'goodsmodels.update'=>'app\modules\v1\forms\goods\models\UpdateForm',
        'goodsmodels.getlist'=>'app\modules\v1\forms\goods\models\GetListForm',
        'goodsmodels.getall'=>'app\modules\v1\forms\goods\models\GetAllForm',

    ];


}