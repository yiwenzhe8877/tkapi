<?php

namespace app\modules\v1\forms\goods\detail;

use app\componments\tb\H5;
use app\componments\utils\ApiException;
use app\componments\common\CommonForm;
use app\componments\utils\HttpUtils;
use app\models\tkgoods\Category;


class GetoneForm extends CommonForm
{
    public $goodsid;


    public function addRule(){
        return [
            [['goodsid'],'required','message'=>'商品id不能为空'],
        ];
    }


    public function run($form){
//        $url='https://m.gome.com.cn/index.php?ctl=goods_class&act=ajaxGetClassList&cid=17951851';
//        $result=HttpUtils::get($url,'','','',true,'');
//        $second=json_decode($result)->secondLevelCategories;
//        for ($i=0;$i<count($second);$i++){
//            $second_id=$second[$i]->goodsTypeId;
//            $second_name=$second[$i]->goodsTypeName;
//            $pid='22';
//
//            $obj=Category::find()->
//                where(['=','cateid',$second_id])->one();
//
//            $obj= new Category();
//            $obj->cateid=$second_id;
//            $obj->pid=$pid;
//            $obj->level=2;
//            $obj->name=$second_name;
//            $obj->save();
//            $goodsTypeList=$second[$i]->goodsTypeList;
//
//            for($j=0;$j<count($goodsTypeList);$j++){
//                $cateid=$goodsTypeList[$j]->goodsTypeId;
//                $third_name=$goodsTypeList[$j]->goodsTypeName;
//                $third_pic=$goodsTypeList[$j]->goodsTypeImgUrl;
//
//                $obj= new Category();
//                $obj->cateid=$cateid;
//                $obj->pid=$second_id;
//                $obj->level=3;
//                $obj->name=$third_name;
//                $obj->pic=$third_pic;
//                $obj->save();
//            }
//
//        }
//        return '';

        $h5=new H5();
        $data= $h5->detail($form->goodsid);

        if($data['code']!='0'){
            ApiException::run('没有找到该商品的优惠信息','10020004');

        }
        return $data['data'];
    }


}