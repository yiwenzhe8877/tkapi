<?php

namespace app\modules\v1\forms\search\hot;


use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;


class GetAllForm extends CommonForm
{



    public function run($form){


//        $cache=\Yii::$app->cache;
//        $cache->set('hotkey','va11lue',100);
//        $cache->exists('a');
//
//        echo \Yii::$app->cache->get("a");
//        return;
       $data= json_decode(Hdk::hot_key())->data;

       $temp=[];

       if(count($data)>20){
           $count=20;
       }else{
           $count=count($data);
       }

       for ($i=0;$i<$count;$i++){
           array_push($temp,$data[$i]);
       }
       return ['list'=>$temp];
    }


}