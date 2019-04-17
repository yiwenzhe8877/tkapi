<?php

namespace app\modules\v1\forms\goods\lists;


use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\tb\H5;
use app\componments\utils\ApiException;
use app\componments\utils\ResponseMap;
use app\modules\v1\forms\CommonForm;

class MianDanForm extends CommonForm
{
    public $page;
    public $type;


    public function addRule(){
        return [
            [['page','type'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){


        $cache=\Yii::$app->cache;

        $type=$form->type;
        $page=$form->page;

        $key='md_'.$type.'_'.$page;

        $mddata=$cache->get($key);
        if($mddata==false){

            $tb=new H5();
            $mddata=$tb->getMd($form->page,'');

            $cache->set($key,$mddata,'3600');
            return ['list'=>$mddata];

        }
        return ['list'=>$mddata];



    }

}