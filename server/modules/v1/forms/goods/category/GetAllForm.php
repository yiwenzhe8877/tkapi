<?php

namespace app\modules\v1\forms\goods\category;



use app\componments\sql\SqlGet;
use app\modules\v1\forms\CommonForm;

class GetAllForm extends CommonForm
{



    public function run($form){
        $cache=\Yii::$app->cache;
        $data=$cache->get("goods_category");
        if($data==false){
            $obj=new SqlGet();
            $obj->setTableName('tkgoods_category');
            $all= $obj->get_all()['list'];

            $temp=[];
            //1 级别
            for($i=0;$i<count($all);$i++){
                $item=$all[$i];

                if($item['level']==1){
                    $item['one']=[];
                    array_push($temp,$item);
                }
            }

            //2 级别
            $has_level_2=[];
            for($i=0;$i<count($all);$i++){
                $item_1=$all[$i];

                for($j=0;$j<count($temp);$j++){
                    $item_2=$temp[$j];
                    if($item_2['cateid']==$item_1['pid']){

                        if(!in_array($item_1['cateid'],$has_level_2)){
                            array_push($has_level_2,$item_1['cateid']);
                            $item_1['two']=[];
                            array_push($temp[$j]['one'],$item_1);
                        }
                    }
                }
            }


            //3 级别
            $has_level_3=[];
            for($i=0;$i<count($all);$i++){
                $item_1=$all[$i];

                for($j=0;$j<count($temp);$j++){
                    $level_1=$temp[$j];

                    for($m=0;$m<count($level_1['one']);$m++){
                        $level_2=$level_1['one'][$m];

                        if($item_1['pid']==$level_2['cateid']){

                            if(!in_array($item_1['id'],$has_level_3)){
                                array_push($has_level_3,$item_1['id']);
                                array_push($temp[$j]['one'][$m]['two'],$item_1);
                            }
                        }
                    }
                }
            }

            $cache->set('goods_category',$temp);

            return  ['list'=>$temp];
        }else{
            return ['list'=>$data];
        }








    }

}