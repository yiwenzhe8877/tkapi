<?php

namespace app\modules\v2\forms\goods\category;



use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\models\api\store\user\StoreUserApi;
use app\models\goods\category;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{

    public $classid;
    public $classname;
    public $level;
    public $pid;


    public function addRule(){
        return [
            [['classname','level','pid','classid'],'required','message'=>'{attribute}不能为空'],

            [['classid'], 'exist','targetClass' => 'app\models\goods\category', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){


        $cate=category::findOne(['=','classid',$form->classid]);
        if($cate->store_id!=StoreUserApi::getLoginedStoreId())
            ApiException::run("该商品类别不属于此店铺",'-1',__CLASS__,__METHOD__,__LINE__);


        $obj=new SqlUpdate();
        $obj->setTableName('goods_category');
        $obj->setData($form);
        $obj->setWhere(['classid='=>$form->classid]);
        return $obj->run();

    }
}