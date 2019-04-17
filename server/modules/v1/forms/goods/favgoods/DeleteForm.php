<?php

namespace app\modules\v1\forms\goods\favgoods;




use app\componments\common\CommonForm;
use app\componments\sql\SqlDeleteTrue;
use app\models\tkuser\Base;

class DeleteForm extends CommonForm
{

    public $id;


    public function addRule(){
        return [
            [['id'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){

        $phone=Base::getUserPhone();
        $goodsid=$form->id;

        $obj=new SqlDeleteTrue();
        $obj->setWhere(['goodsid='=>$goodsid,' and phone='=>$phone]);
        $obj->setTableName('tkuser_favgoods');

        return $obj->run();

    }


}