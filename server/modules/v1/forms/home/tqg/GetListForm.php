<?php

namespace app\modules\v1\forms\home\tqg;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\tb\H5;
use app\componments\utils\DateUtils;
use app\componments\utils\HttpUtils;

class GetListForm extends CommonForm
{
    public $page;
    public $status; // 时间标志


    public function addRule(){
        return [
            [['page','status'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){


        $head= DateUtils::getymdshort();
        $head.=$form->status.'00';

        $cache=\Yii::$app->cache;

        $ret=$cache->get('tqg'.$form->page.$head);
        if($ret){
            return ['list'=>$ret];
        }

        $h5=new H5();
        $data= $h5->getTQGbytime($head,$form->page);

        $all=[];
        for ($i=0;$i<count($data);$i++){
            $item = $data[$i];
            $temp=[
                'itemId'=>$item->itemId,
                'picUrl'=>'https:'.$item->picUrl,
                'name'=>$item->name,
                'selfSellingPoint'=>isset($item->selfSellingPoint)?$item->selfSellingPoint:'',
                'salePrice'=>$item->salePrice,
                'price'=>$item->price,
                'soldRate'=>$item->soldRate
            ];
            array_push($all,$temp);
        }

        $cache->set('tqg'.$form->page.$head,$all,3600);

        return ['list'=>$all];

    }
    /*
     * $head= DateUtils::getymdshort();
        $head.=$form->status.'00';

        $cache=\Yii::$app->cache;

        $ret=$cache->get('tqg'.$form->page.$head);
        if($ret){
            return ['list'=>$ret];
        }

        $h5=new H5();
        $data= $h5->getTQGbytime($head,$form->page);
        $cache->set('tqg'.$form->page.$head,$data,3600);

        return ['list'=>$data];
     * */

}