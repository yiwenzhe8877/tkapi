<?php

namespace app\modules\v1\forms\home\jhs;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\tb\H5;
use app\componments\utils\HttpUtils;

class GetAllForm extends CommonForm
{
    public $page;
    public $status; // 今日1 ，昨日2 预告3


    public function addRule(){
        return [
            [['page','status'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $cache=\Yii::$app->cache;

        $ret=$cache->get('jhs'.$form->page.$form->status);

        if($ret){
            return ['list'=>$ret];
        }

        $h5=new H5();
        $data= $h5->getJHS($form->page,$form->status);

        $all=[];

        for ($i=0;$i<count($data);$i++){
            $item = $data[$i];
            $temp=[
                'picUrl'=>$item->baseinfo->picUrl,
                'title'=>$item->name->title,
                'ostimeText'=>$item->baseinfo->ostimeText,
                'merits'=>$item->merit,
                'actPrice'=>$item->price->actPrice,
                'origPrice'=>$item->price->origPrice,
                'soldCount'=>$item->remind->soldCount
            ];
            array_push($all,$temp);
        }

        $cache->set('jhs'.$form->page.$form->status,$all,3600);

        return ['list'=>$all];
    }


}