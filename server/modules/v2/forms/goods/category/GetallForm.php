<?php

namespace app\modules\v2\forms\goods\category;



use app\models\api\goods\category\GoodsCategoryApi;
use app\modules\v2\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){


       return ['list'=>GoodsCategoryApi::getRelation()];

    }

}