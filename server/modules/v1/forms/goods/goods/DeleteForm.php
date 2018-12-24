<?php

namespace app\modules\v1\forms\goods\goods;



use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $id;


    public function run($form){
        $obj=new SqlUpdate();
        $obj->setTableName('goods_goods');
        $obj->setData(['del'=>'1']);
        $obj->setWhere(['goods_id='=>$form->goods_id]);
        return $obj->run();

    }

}