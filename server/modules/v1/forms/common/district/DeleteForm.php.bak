<?php

namespace app\modules\v1\forms\common\district;



use app\componments\utils\ApiException;
use app\models\user;
use app\modules\v1\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $id;



    public function run($form){

        $arr=explode(',',$form->id);



        foreach ($arr as $v){
            $model=user::find()
                ->andWhere(['=','user_id',$v])
                ->one();

            if(!$model){
                ApiException::run("用户id不存在",'900001');
            }

            $model=user::findOne($v);
            $model->del=1;
            $model->save();
        }
        return "";


    }

}