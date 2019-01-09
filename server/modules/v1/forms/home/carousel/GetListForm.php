<?php

namespace app\modules\v1\forms\home\carousel;



use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;
use app\componments\sql\SqlGet;

class GetListForm extends CommonForm
{



    public function run(){


        $arr=[
            [
                'img'=>'http://img.haodanku.com/Fl4ihpfUjWwzJ90zXh1rA3zseLZa',
                'title'=>'美妆',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/Fmw4OVrODSIFfdi0OFaidKYeqe-T',
                'title'=>'裙子女冬',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/FjcWcqW1sXsBbC0_wLEWLZkQR5Bq',
                'title'=>'9.9包邮好货',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/FqydWIGVpsiQNVmPetVy9VEzm2H8',
                'title'=>'暖脚',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/FhiWQ-0SEMWdD3dlN3XkWJZw7XdV',
                'title'=>'追剧零食',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/FuUFPnIzpc2aNgIqIH2qNFgBXmiq',
                'title'=>'出租屋',
                'status'=>2
            ],
            [
                'img'=>'http://img.haodanku.com/FmrPu6_0DXsSH8UQljj5hwvdbEqD',
                'title'=>'暖胃',
                'status'=>2
            ],
        ];
        return $arr;


        $cache=\Yii::$app->cache;

//        $ret=$cache->get('homecarousel');
//        if($ret){
//           return $ret;
//        }
        

        $d=json_decode(Hdk::talent_info())->data->topdata;

        return $d;

        $all=[];
        $l=count($d);
        if($l>8){
            $len=8;
        }else{
            $len=$l;
        }

        for($i=0;$i<$len;$i++){
            $item=$d[$i];
            $temp=[];

            //状态1 表示商品 2表示列表 3 表示链接
            $temp['shorttitle']=$item->shorttitle;
            $temp['img']=$item->app_image;
            $temp['status']=2;
            array_push($all,$temp);
        }

        $cache->set('homecarousel',$all,7200);

        return $all;
    }

}