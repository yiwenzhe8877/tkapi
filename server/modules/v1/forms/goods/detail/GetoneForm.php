<?php

namespace app\modules\v1\forms\goods\detail;

use app\componments\sql\SqlUpdate;
use app\componments\tb\H5;
use app\componments\utils\ApiException;
use app\componments\common\CommonForm;
use app\componments\utils\HttpUtils;
use app\models\tkgoods\Category;
use app\models\tkuser\Order;


class GetoneForm extends CommonForm
{
    public $goodsid;


    public function addRule(){
        return [
            [['goodsid'],'required','message'=>'商品id不能为空'],
        ];
    }


    public function run($form){


        $h5=new H5();
        $data= $h5->detail($form->goodsid);

        if($data['code']!='0'){
            ApiException::run('没有找到该商品的优惠信息','10020004');
        }
        return $data['data'];
    }


}