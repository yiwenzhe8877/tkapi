<?php

namespace app\modules\v1\forms\statistics\index;

use app\componments\sql\SqlCreate;

use app\models\api\statistics\OrderStatisticsApi;
use app\modules\v1\forms\CommonForm;

class GetForm extends CommonForm
{

    public function run($form){

       $where=[];

       $where['store_id']=$form->store_id;


       return [
         'orderNum'=>OrderStatisticsApi::getOrderNum([])
       ];
    }
}