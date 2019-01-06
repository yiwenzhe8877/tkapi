<?php

namespace app\modules\v1\forms\home\carousel;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;

class GetListForm extends CommonForm
{



    public function run(){



        $cache=\Yii::$app->cache;

        $ret=$cache->get('homecarousel');
        if($ret){
           return $ret;
        }
        

        $d=json_decode(Hdk::talent_info())->data->topdata;

        $all=[];
        $l=count($d);
        if($l>8){
            $len=8;
        }else{
            $len=$l;
        }

        for($i=0;$i<$len;$i++){
            $item=$d[$i];
            $temp=[];

            //状态1 表示商品 2表示列表 3 表示链接
            $temp['shorttitle']=$item->shorttitle;
            $temp['img']=$item->app_image;
            $temp['status']=2;
            array_push($all,$temp);
        }

        $cache->set('homecarousel',$all,7200);

        return $all;
    }

}