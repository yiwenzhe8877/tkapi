<?php

namespace app\modules\v1\forms\goods\detail;

use app\componments\image\MyImage;
use app\componments\sql\SqlUpdate;
use app\componments\tb\H5;
use app\componments\utils\ApiException;
use app\componments\common\CommonForm;
use app\componments\utils\DateUtils;
use app\componments\utils\HttpUtils;
use app\models\tkgoods\Category;
use app\models\tkuser\Order;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use Da\QrCode\QrCode;
use yii\helpers\FileHelper;


class GetsharepicForm extends CommonForm
{
    public $goodsid;


    public function addRule(){
        return [
            [['goodsid'],'required','message'=>'商品id不能为空'],
        ];
    }


    public function run($form){


        $tb=new H5();
        $detail=$tb->detail($form->goodsid);
        $myimg=new MyImage();
        $t=DateUtils::getLinuxTime();
        $ymd=DateUtils::getymdshort();

        if(!is_dir(DATA_PATH.'/images/'.$ymd)){
            mkdir(DATA_PATH.'/images/'.$ymd);
        }

        $pic_dir=DATA_PATH.'/images/'.$ymd.'/';
        $pic_name=$t.'00.png';

        $banner_path=$pic_dir.$pic_name;
        $myimg->resize_image('https:'.$detail['data']['banner'][0], $pic_dir.$pic_name, '500','500');

        //获得背景图地址
        $bg_path=DATA_PATH.'/tpl/500_700.png';
        $pic_path=$pic_dir.$pic_name;

        //合并banner
        $bind_path=$pic_dir.$t.'bind.png';
        $myimg->bindImages($bg_path,$pic_path,0,0,$pic_dir,$t.'bind.png');

        //合并二维码
        $url='https://www.baidu.com?token='.$detail['data']['jun']['data']->taoToken;

        $afterprice=$detail['data']['jun']['data']->afterprice;
        $originprice=$detail['data']['jun']['data']->originprice;
        $couponAmount=$detail['data']['jun']['data']->couponAmount;
        $volume=$detail['data']['jun']['data']->volume;
        $afterprice= sprintf("%.2f",$afterprice);
        $originprice= sprintf("%.2f",$originprice);
        $erweima_path=DATA_PATH.'/images/'.$ymd.'/'.$t.'qrcode.jpg';
        FileHelper::createDirectory(dirname($erweima_path));
        $qrCode = (
        new QrCode($url, ErrorCorrectionLevelInterface::HIGH)
        )
            ->useEncoding('UTF-8')->setLogoWidth(60)->setSize(100)->setMargin(5);
        $qrCode->writeFile($erweima_path);

        $pic_name=$t.'bind.png';
        $pic_path=$pic_dir.$pic_name;
        $myimg->bindImages($bind_path,$erweima_path,370,550,$pic_dir,$pic_name);

        $font= realpath(DATA_PATH.'/font/msyh.ttf');
        $text=$detail['data']['jun']['data']->auctionTitle;

        //合并文字
        $myimg->bindText($pic_path,$pic_path,$text,'10','540',$font,'12','00','00','00');
        $myimg->bindText($pic_path,$pic_path,'长按识别二维码','368','680',$font,'12','234','77','78');
        $myimg->bindText($pic_path,$pic_path,'券后￥'.$afterprice,'10','650',$font,'16','234','77','78');
        $myimg->bindText($pic_path,$pic_path,'原价￥'.$originprice,'140','650',$font,'12','99','99','99');
        $myimg->bindText($pic_path,$pic_path,'月销:'.$volume,'260','650',$font,'14','99','99','99');

        if($couponAmount>0){
            $myimg->bindText($pic_path,$pic_path,'券面值￥'.$couponAmount,'10','600',$font,'20','234','77','78');
        }

        @unlink($banner_path);
        @unlink($erweima_path);

        return ['url'=>realpath($bind_path)];
    }


}