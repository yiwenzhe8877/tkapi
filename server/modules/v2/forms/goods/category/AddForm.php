<?php

namespace app\modules\v2\forms\goods\category;


use app\componments\sql\SqlCreate;
use app\models\api\store\user\StoreUserApi;
use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{

    public $classname;
    public $level;
    public $pid;


    public function addRule(){
        return [
            [['classname','level','pid'],'required','message'=>'{attribute}不能为空'],
            ['classname', 'unique', 'targetClass' => 'app\models\goods\category', 'message' => '{attribute}已经被使用。'],
        ];
    }


    public function run($form){
        $cover=[
            'classtype'=>'industy',
            'store_id'=>StoreUserApi::getLoginedStoreId()
        ];

        $obj=new SqlCreate();
        $obj->setTableName('goods_category');
        $obj->setData($form);
        $obj->setCoverData($cover);
        return $obj->run();
    }


}