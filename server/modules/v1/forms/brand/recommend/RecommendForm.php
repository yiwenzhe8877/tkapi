<?php

namespace app\modules\v1\forms\brand\recommend;



use app\componments\common\CommonForm;
use app\models\tkbrand\Recommend;

class RecommendForm extends CommonForm
{



    public function run(){


        $cache=\Yii::$app->cache;

//        $ret=$cache->get('brand-recommend');
//        if($ret){
//            return $ret;
//        }


        $data=Recommend::find()->all();

        $brandarr=[];
        $tempword=[];
        for($i=0;$i<count($data);$i++){
            if(!in_array($data[$i]->category,$tempword)){
                array_push($tempword,$data[$i]->category);
            }
        }

        for ($i=0;$i<count($tempword);$i++){
            $tmp=[];
            $tmp['title']=$tempword[$i];
            $tmp['child']=[];
            array_push($brandarr,$tmp);
        }


        $in=[];

        for($j=0;$j<count($brandarr);$j++){
            for($i=0;$i<count($data);$i++){

                if($brandarr[$j]['title']==$data[$i]->category && !in_array($data[$i]->id,$in)){
                    $data[$i]->pic="https:".$data[$i]->pic;
                    array_push($brandarr[$j]['child'],$data[$i]);
                    array_push($in,$data[$i]->id);
                }
            }
        }

        $cache->set('brand-recommend',$brandarr,7200);

        return $brandarr;
    }

}