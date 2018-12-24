<?php


namespace app\models\api\common\setting;


use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\models\common\setting;


class CommonSettingApi
{
    public static function getValue($type,$key){
       $ret= setting::find()
           ->andWhere(['=','type',$type])
           ->andWhere(['=','key',$key])
           ->one();

       if(!$ret)
           ApiException::run("微信配置错误".$key);

       return $ret->value;

    }
}