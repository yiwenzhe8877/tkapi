<?php

namespace app\controllers;

use app\componments\sql\SqlUpdate;
use app\componments\tb\H5;
use app\componments\utils\DateUtils;
use app\componments\utils\HttpUtils;
use app\componments\utils\TableUtils;
use app\models\tkuser\Order;
use Da\QrCode\Contracts\ErrorCorrectionLevelInterface;
use Da\QrCode\QrCode;
use yii\helpers\FileHelper;
use yii\web\Controller;

use app\componments\image\MyImage;
class SiteController extends Controller
{


    public function actionIndex()
    {
        $ret=HttpUtils::get('https://ju.taobao.com/search.htm?stype=activityPrice&reverse=up&page=1','','','',true);
        $outPageTxt = mb_convert_encoding($ret, 'utf-8','GB2312');

        $temp=[];
        $reg3='/item-small-v3[\s\S]*?a\shref="(.*?)"[\s\S]*?src="(.*?)"[\s\S]*?title="(.*?)"[\s\S]*?yen".(.*?)<[\s\S]*?cent".(.*?)<[\s\S]*?orig-price".(.*?)<[\s\S]*?(soldout-mask"\ssrc="(.*?)")/';
        $reg4='/item-small-v3[\s\S]*?<\/li>/';


        if( preg_match_all($reg4,$outPageTxt,$match)){

            $l=count($match[0]);
            $item=$match[0];
            for($i=0;$i<$l;$i++){
                $t=[];

                $item_2=$item[$i];

                preg_match('/item_id=(.*?)"/',$item_2,$m1);
                $goodsid='';
                if(count($m1)>0){
                    $goodsid=$m1[1];
                }

                preg_match('/src="(.*?)"/',$item_2,$m1);
                $img='';
                if(count($m1)>0){
                    $img=$m1[1];
                }

                if($img=='//g.alicdn.com/s.gif'){
                    preg_match('/lazyload="(.*?)"/',$item_2,$m1);
                    $img=$m1[1];
                }

                preg_match('/title="(.*?)"/',$item_2,$m1);
                $title='';
                if(count($m1)>0){
                    $title=$m1[1];
                }

                preg_match('/yen".(.*?)</',$item_2,$m1);
                preg_match('/cent".(.*?)</',$item_2,$m2);

                $afterprice='';
                if(count($m1)>0){
                    $afterprice=$m1[1];
                }
                if(count($m2)>0){
                    $afterprice.=$m2[1];
                }

                preg_match('/class="orig-price".(.*?)</',$item_2,$m1);
                $originprice='';
                if(count($m1)>0){
                    $originprice=$m1[1];
                }
                preg_match('/soldout-mask/',$item_2,$m1);
                $sellout='';

                if(count($m1)>0){
                    $sellout='//gtms01.alicdn.com/tps/i1/TB19yiFGFXXXXatXFXXR8rl3FXX-192-192.png';
                }
                $t=[
                    'goodsid'=>$goodsid,
                    'img'=>$img,
                    'title'=>$title,
                    'afterprice'=>$afterprice,
                    'originprice'=>$originprice,
                    'sellout'=>$sellout
                ];
                array_push($temp,$t);
            }
        }
        var_dump($temp);


        return;



        $tb=new H5();
        $detail=$tb->detail('579455446457');
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
        $bg_path=DATA_PATH.'/tpl/500_700_1.png';
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

        $font= realpath(DATA_PATH.'/font/msyh.TTF');
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


        return  realpath($bind_path);





        return ;
        return $file;
        set_time_limit(0);

        $list=Order::find()
            ->andWhere(['=','goodspic',''])
            ->all();

        for ($i=0;$i<count($list);$i++){
            $goodsid=$list[$i]->goodsid;
            $orderid=$list[$i]->orderid;
            $h5=new H5();

            $data= $h5->getTBdata($goodsid);
            if(!isset($data->item)){
                $img='https://a.deyuntianxia.com/placeholder_img.png';
            }else{
                $img= 'https:'.$data->item->images[0];
            }
            $obj=new SqlUpdate();
            $obj->setTableName('tkuser_order');
            $obj->setData(['goodspic'=>$img]);
            $obj->setWhere(['orderid='=>$orderid]);
            $obj->run();
        }
        return;
        $result = TableUtils::getAllTableNames();
        $module_arr=['v1'];
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);

            $tablename='tk_'.$arr[1].'_'.$arr[2];

            foreach ($module_arr as $k1=>$module){
                $this->makeFactoryCurd($module);
                $this->makeApi($tablename);
                $this->makeModel($tablename);
               // $this->makeFactory($tablename,$module);
                $this->addform($tablename,$module,'add');
                $this->deleteform($tablename,$module,'delete');
                $this->updateform($tablename,$module,'update');
                $this->getlistform($tablename,$module,'getlist');
                $this->getallform($tablename,$module,'getall');
                $this->sqlCreate();
            }
        }


    }

    private function sqlCreate(){
        $result = TableUtils::getAllTableNames();
        $str='';
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);
            $m=$arr[1]."_".$arr[2];
            $n="app\\models\\".$arr[1]."\\".$arr[2];
            $str.='"'.$m.'"'.'=>'."'".$n."'".','."\r\n\t";
        }

        $z=file_get_contents('./template/sqlcreate.txt');
        $z=str_replace('{models}',$str,$z);

        $path='../componments/sql/SqlCreate.php';
        if(file_exists($path)){
            unlink($path);

        }

        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $z);
        fclose($myfile);

    }

    private function makeFactoryCurd($module){
        $result = TableUtils::getAllTableNames();

        $methods_map=['add','update','delete','getlist','getall'];

        $str='';
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);

            //app\modules\v2\factory\store\UserFactory
            foreach ($methods_map as $a=>$b){
                $m=$arr[1].$arr[2];
                $n="app\\modules\\$module\\forms\\".$arr[1]."\\".$arr[2]."\\".$b.'Form';
                $str.='"'.$m.'.'.$b.'"'.'=>'."'".$n."'".','."\r\n\t";
            }
        }


        $z=file_get_contents('./template/factory_curd.txt');

        $z=str_replace('{methods}',$str,$z);
        $z=str_replace('{module}',$module,$z);

        $path='../modules/'.$module.'/factory/Factory.php';
        if(file_exists($path)){
            unlink($path);
        }

        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $z);
        fclose($myfile);

    }



    private function makeApi($tablename){
        if($tablename=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/api.txt');
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{classname}',ucfirst($one).ucfirst($two).'Api',$z);

        $dir_one='../models/api/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($one).ucfirst($two).'Api.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }

    }

    private function makeModel($tablename){
        if($tablename=='')return;

        $arr=explode('_',$tablename);
        $z=file_get_contents('./template/model.txt');
        $z=str_replace('{dir}',$arr[1],$z);
        $z=str_replace('{class}',$arr[2],$z);
        $z=str_replace('{tablename}',$tablename,$z);
        $dir='../models/'.$arr[1];
        $filename=$arr[2].'.php';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        if(!file_exists($dir.'/'.$filename)){
            $myfile = fopen($dir.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }


    }

    private function makeFactory($tablename,$module){
        if(empty($tablename)||empty($module))return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/factory.txt');
        $z=str_replace('{dir}',$one,$z);
        $z=str_replace('{class}',ucfirst($two).'Factory',$z);
        $z=str_replace('{tablename}',$one.$two,$z);
        $z=str_replace('{subdir}',$two,$z);
        $z=str_replace('{module}',$module,$z);


        $dir='../modules/'.$module.'/factory/'.$one;
        $filename=ucfirst($two).'Factory.php';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        if(!file_exists($dir.'/'.$filename)){
            $myfile = fopen($dir.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function makeform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);



        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function addform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);
        $str="";
        for ($i=1;$i<count($f);$i++){
            $str.='public $'.$f[$i].";\r\n\t";
        }
        $z=str_replace('{fields}',$str,$z);


        $str="";
        for ($i=1;$i<count($f);$i++){
            $str.='"'.$f[$i].'"'.',';
        }
        $str=substr($str,'0',strlen($str)-1);
        $z=str_replace('{required}',$str,$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function updateform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        //字段
        $str="";
        for ($i=0;$i<count($f);$i++){
            $str.='public $'.$f[$i].";\r\n\t";
        }
        $z=str_replace('{fields}',$str,$z);

        //必填项
        $str="";
        for ($i=0;$i<count($f);$i++){
            $str.='"'.$f[$i].'"'.',';
        }
        $str=substr($str,'0',strlen($str)-1);
        $z=str_replace('{required}',$str,$z);

        //id
        $z=str_replace('{id}',$f[0],$z);
        $tablepath=$one.'\\'.$two;

        $z=str_replace('{tablepath}',$tablepath,$z);

        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function getallform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        //字段

        //必填项



        //id
        $z=str_replace('{id}',$f[0],$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }


    public function getlistform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);



        //id
        $z=str_replace('{id}',$f[0],$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function deleteform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        $z=str_replace('{id}',$f[0],$z);
        $tablepath=$one.'\\'.$two;

        $z=str_replace('{tablepath}',$tablepath,$z);



        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }




}
