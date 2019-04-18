<?php

namespace app\modules\v1\forms\home\recommend;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;

class GetListForm extends CommonForm
{
    public $page;
    public $pagesize;
    public $nav;


    public function addRule(){
        return [
            [['pagesize','nav','page'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $cache=\Yii::$app->cache;

        $key='home'.$form->nav.$form->pagesize.$form->page;

        $ret=$cache->get($key);
        if($ret){


            return $ret;
        }
        $data=Hdk::goodslist($form->page,$form->nav,'0',$form->pagesize);
        $all=[
            'list'=>[],
            'nexpage'=>0
        ];

        $d= json_decode($data)->data;
        for ($i=0;$i<count($d);$i++){
            $item =  $d[$i];
            $temp=[
                'itemid'=>$item->itemid,
                'itempic'=>$item->itempic,
                'itemtitle'=>$item->itemtitle,
                'shoptype'=>$item->shoptype,
                'shopname'=>$item->shopname,
                'couponmoney'=>$item->couponmoney,
                'itemendprice'=>$item->itemendprice,
                'itemsale'=>$item->itemsale
            ];
            array_push($all['list'],$temp);
        }
        $page= json_decode($data)->min_id;
        $all['nexpage']=$page;

        $cache->set($key,$all,3600);

        return $all;
    }


}