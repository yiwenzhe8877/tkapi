<?php

namespace app\modules\v1\forms\home\recommend;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;
use app\componments\tb\H5;
use app\componments\utils\HttpUtils;

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
            $list= json_decode($ret)->data;
            $page= json_decode($ret)->min_id;

            //return ['list'=>$list,'nextpage'=>$page];
        }
        $data=Hdk::goodslist($form->page,$form->nav,'0',$form->pagesize);
        //var_dump($data);
        $cache->set($key,$data,3600);
        $list= json_decode($data)->data;
        $page= json_decode($data)->min_id;

        return ['list'=>$list,'nextpage'=>$page];
    }


}