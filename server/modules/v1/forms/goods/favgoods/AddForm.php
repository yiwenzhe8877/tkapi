<?php

namespace app\modules\v1\forms\goods\favgoods;




use app\componments\common\CommonForm;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlUpdate;
use app\componments\tb\H5;
use app\componments\utils\ApiException;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\models\tkuser\Base;
use app\models\tkuser\FavGoods;

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

        $fav=FavGoods::find()
            ->andWhere(['=','goodsid',$form->goodsid])
            ->andWhere(['=','phone',$phone])
            ->one();

        if($fav){
            ApiException::run("商品已经添加到收藏了",'900000');
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
        return $obj->run();
    }


}