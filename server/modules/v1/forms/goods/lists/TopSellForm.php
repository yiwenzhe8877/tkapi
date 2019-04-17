<?php

namespace app\modules\v1\forms\goods\lists;


use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\utils\ApiException;
use app\componments\utils\ResponseMap;
use app\modules\v1\forms\CommonForm;

class TopSellForm extends CommonForm
{
    public $type;


    public function addRule(){
        return [
            [['type'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){


        $cache=\Yii::$app->cache;



        $type=$form->type;
        $topsell=$cache->get("topsell_".$type);
        if($topsell==false){
            $d= Hdk::sales_list($form->type);
            $d=json_decode($d);

            $code=$d->code;
            if($code=='1'){
                $page=$d->min_id;
                $data=$d->data;

                $cache->set('topsell_'.$type,$data,'7200');

                return ['list'=>$data];
            }
        }
        return ['list'=>$topsell];





        ApiException::run(ResponseMap::Map('10020004'),'10020004');
    }

}