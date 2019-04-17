<?php

namespace app\modules\v1\forms\goods\favgoods;


use app\componments\common\CommonForm;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlDeleteTrue;
use app\componments\tb\H5;
use app\models\tkuser\Base;
use app\models\tkuser\FavGoods;
use dosamigos\qrcode\QrCode;

class AddForm extends CommonForm
{

    public $goodsid;


    public function addRule(){
        return [
            [['goodsid'],'required','message'=>'提交的数据不能为空'],

        ];
    }

    public function run($form){





        $phone=Base::getUserPhone();

        $fav=FavGoods::find()
            ->andWhere(['=','goodsid',$form->goodsid])
            ->andWhere(['=','phone',$phone])
            ->one();

        if($fav){
            $obj=new SqlDeleteTrue();
            $obj->setTableName('tkuser_favgoods');
            $obj->setWhere(['goodsid='=>$form->goodsid]);
            $obj->run();
            return ['msg'=>"取消收藏",'status'=>0];
        }

        $h5=new H5();
        $data= $h5->detail($form->goodsid)['data'];

        $jun=$data['jun']['data'];
        $seller=$data['seller'];
        $apistack=$data['apistack'];
        $shoptype=1;
        if($seller->sellerType=='C'){
            $shoptype=1;
        }
        if($seller->sellerType=='B'){
            $shoptype=2;
        }

        $cover=[
            'goodsid'=>$form->goodsid,
            'phone'=>Base::getUserPhone(),
            'goodspic'=>$jun->pictUrl,
            'title'=>$jun->auctionTitle,
            'shoptype'=>$shoptype,
            'shopname'=>$seller->shopName,
            'originprice'=>$jun->originprice,
            'afterprice'=>$jun->afterprice,
            'sellnum'=>$apistack->sellCount,
            'couponamount'=>$jun->couponAmount,
        ];

        $obj=new SqlCreate();
        $obj->setTableName('tkuser_favgoods');
        $obj->setCoverData($cover);
        $obj->run();
        return ['msg'=>"收藏成功",'status'=>1];
    }


}