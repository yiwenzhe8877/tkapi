<?php

namespace app\modules\v1\forms\home\mosthot;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;

class MostHotForm extends CommonForm
{



    public function run(){



        $cache=\Yii::$app->cache;

        $ret=$cache->get('homemosthot');
        if($ret){
            return $ret;
        }


        $d=json_decode(Hdk::selected_item(1))->data;

        $all=[];
        $len=count($d);


        for($i=0;$i<$len;$i++){
            $item=$d[$i];
            $temp=[];

            $temp['itemid']=$item->itemid;
            $temp['title']=$item->title;
            array_push($all,$temp);
        }

        $cache->set('homemosthot',$all,7200);

        return $all;
    }

}