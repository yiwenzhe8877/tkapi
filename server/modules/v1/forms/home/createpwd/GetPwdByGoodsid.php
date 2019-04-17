<?php

namespace app\modules\v1\forms\home\createpwd;



use app\componments\common\CommonForm;
use app\componments\jun\jun;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\zfbtransfer\Alipay;
use app\componments\zfbtransfer\Transfer;

class GetPwdByGoodsid extends CommonForm
{
    public $goodsid;


    public function addRule(){
        return [
            [['goodsid'],'required','message'=>'{attribute}数据不能为空'],
        ];
    }


    public function run($form){



        $goodsid= $form->goodsid;

        $cache=\Yii::$app->cache;
        $key='md_'.$goodsid;
        $ret=$cache->get($key);
        if($ret){
           return $ret;
        }
        $jun = new Jun();
        $url='https://item.taobao.com/item.htm?id='.$goodsid;
        $ret=$jun->createpwd($url);
        return $ret;

        $d=json_decode(Hdk::talent_info())->data->topdata;

        return $d;

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