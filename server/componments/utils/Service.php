<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/1
 * Time: 19:42
 */

namespace app\componments\utils;


class Service
{
    public static function getServiceName(){
        $request= \Yii::$app->getRequest();
        $service='';

        if(isset($request->headers['service']) && !empty($request->headers['service']))
            $service=$request->headers['service'];


        if(empty($service))
            $service=$request->post('service');



        if(!isset($service) || empty($service))
            ApiException::run(ResponseMap::Map('10010015'),'10010015',__CLASS__,__METHOD__,__LINE__);

        return $service;
    }
}