<?php
/**
 * Created by PhpStorm.
 * adminUser: idz025
 * DateUtils: 2018/10/26
 * Time: 9:09
 */

namespace app\componments\utils;


use app\models\tkapi\Exceptionlog;
use yii\base\UserException;

class ApiException
{

    //抛出异常
    public static function run($msg='',$code='900001',$class='',$method='',$line=''){

        if(YII_DEBUG){

            $request=\Yii::$app->getRequest();
            $accessToken='';

            $accessToken=$request->headers['token'];

            if(!$accessToken){
                $accessToken = $request->get('token');
            }

            $model=new Exceptionlog();

            $model->time=time();
            $model->username=empty($accessToken)?'':$accessToken;
            $model->group_name='';
            $model->range=1;
            $model->class=$class;
            $model->method=$method;
            $model->line=$line;
            $model->code=$code;
            $model->msg=$msg;
            $model->save();

        }

        $msg=json_encode(['msg'=>$msg,'location'=>$class.'---'.$method.'---第'.$line.'行']);

        throw new UserException($msg,$code);
    }
}