<?php

namespace app\modules\v1\forms\goods\lists;


use app\componments\jun\jun;
use app\modules\v1\forms\CommonForm;

class JunListForm extends CommonForm
{
    public $sort;
    public $kw;
    public $page;
    public $has_coupon;


    public function addRule(){
        return [
            [['sort','kw','page','has_coupon'],'required','message'=>'{attribute}数据不能为空'],
        ];
    }

    public function run($form){
        $jun = new Jun();

        $has=$form->has_coupon==1?'true':'false';



        $cache=\Yii::$app->cache;

        $key="search".$form->kw.$form->page.$form->sort.$has;

        $c_data=$cache->get($key);
        if($c_data==false){


            $data=$jun->get_goodslist($form->kw,$form->page,$form->sort,$has);
            if(isset($data['error_response'])){
                return ['list'=>[]];
            }

            $list=$data['tbk_dg_material_optional_response']['result_list']['map_data'];

            $cache->set($key,$list,'7200');

            return ['list'=>$list];
        }
        return ['list'=>$c_data];




    }

}