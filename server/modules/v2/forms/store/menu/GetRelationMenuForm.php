<?php

namespace app\modules\v2\forms\store\menu;



use app\models\api\store\menu\StoreMenuApi;
use app\modules\v2\forms\CommonForm;


class GetRelationMenuForm extends CommonForm
{
    public function addRule(){
        return [
        ];
    }

    public function run(){

        return StoreMenuApi::getMenus();
    }

}