<?php


namespace app\models\api\store\menu;


use app\componments\utils\Assert;
use app\models\store\menu;


class StoreMenuApi
{
    public static function getMenus(){


        $data=menu::find()->all();


        $temp=[];
        $all=[];
        for($i=0;$i<count($data);$i++){
            $item=[];
            $item['id']=$data[$i]['id'];
            $item['pid']=$data[$i]['pid'];
            $item['name']=$data[$i]['name'];
            $item['router']=$data[$i]['router'];
            $item['sort']=$data[$i]['sort'];
            $item['del']=$data[$i]['del'];
            $item['ename']=$data[$i]['ename'];


            if($item['pid']==0){
                $item['child']=[];
                array_push($temp,$item);
               // array_push($pidarr,$id);
            }
        }

        $child_arr=[];
        for($i=0;$i<count($data);$i++){
            $pid=$data[$i]['pid'];
            $id=$data[$i]['id'];
            if($pid==0){continue;}

            for($j=0;$j<count($temp);$j++){
                if($pid==$temp[$j]['id'] && !in_array($id,$child_arr)){
                    array_push($temp[$j]['child'],$data[$i]);
                    array_push($child_arr,$id);

                }
            }
        }


        return [
            'list'=>$temp
        ];
    }
}