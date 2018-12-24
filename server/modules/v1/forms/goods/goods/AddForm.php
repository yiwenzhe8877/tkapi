<?php

namespace app\modules\v1\forms\goods\goods;

use app\componments\sql\SqlCreate;
use app\modules\v1\forms\CommonForm;


class AddForm extends CommonForm
{

    public $name;
    public $store; //库存
    public $pic1;
    public $express_type;//1表示使用运费模板，2表示统一邮费


    public function addRule(){
        return [
            [['name','store','pic1','express_type'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){


        $obj=new SqlCreate();
        $obj->setTableName('goods_goods');
        $obj->setData($form);
        return $obj->run();
    }


}