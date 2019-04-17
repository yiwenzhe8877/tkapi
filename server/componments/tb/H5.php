<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/24
 * Time: 9:52
 */
namespace app\componments\tb;

use app\componments\utils\DateUtils;
use app\componments\utils\HttpUtils;
use app\componments\jun\jun;
use app\models\tkuser\Base;
use app\models\tkuser\FavGoods;
use app\models\tkuser\Pid;

class H5
{


    public function getTBdata($goodsid){
        $data= urlencode( '{"itemNumId":"'.$goodsid.'","exParams":"{\"id\":\"'.$goodsid.'\",\"scm\":\"1007.14551.117283.0\",\"pvid\":\"4822a42a-bec9-43c2-9e5c-892b5ff51541\",\"track_params\":\"{\\\"mtx_ab\\\":\\\"1\\\",\\\"mtx_sab\\\":\\\"3\\\"}\",\"spm\":\"a215s.7406091.guessitem.guessitem-9\",\"locate\":\"guessitem-item\",\"rmdChannelCode\":\"guessULike\",\"utparam\":\"{\\\"x_object_type\\\":\\\"item\\\",\\\"mtx_ab\\\":1,\\\"mtx_sab\\\":3,\\\"scm\\\":\\\"1007.14551.117283.0\\\",\\\"x_object_id\\\":38624360220}\"}","detail_v":"3.1.1","ttid":"2018@taobao_iphone_9.9.9","utdid":"123123123123123"}');

        $params=array(
            'data'=>$data,
            'api'=>'mtop.taobao.detail.getdetail',
            'v'=>'6.0',
            'appKey'=>'12574478',
            'jsv'=>'2.5.0',
        );

        $data=$this->req_tbh5($params);

        return $data;
    }
    //获得免单
    public function getMd($page,$type){



        $ret=HttpUtils::get('https://ju.taobao.com/search.htm?stype=activityPrice&reverse=up&page='.$page,'','','',true);
        $outPageTxt = mb_convert_encoding($ret, 'utf-8','GB2312');


        $temp=[];
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


                preg_match('/lazyload="(.*?)"/',$item_2,$m1);
                $img='';
                if(count($m1)>0){
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
        return $temp;
    }


    public function getdetaildesc($goodsid){
        $data= urlencode( '{"id":"'.$goodsid.'","type":"0"}');

        $params=array(
            'data'=>$data,
            'api'=>'mtop.taobao.detail.getdesc',
            'v'=>'6.0',
            'appKey'=>'12574478',
            'jsv'=>'2.5.0',
        );

        $data=$this->req_tbh5($params);

        return $data;
    }

    public function getJHS($page,$status){
        $filter='';
        if($status==1){
            $filter='today';
        }
        if($status==2){
            $filter='old';
        }
        if($status==3){
            $filter='foreshow';
        }


        $time=DateUtils::getLinuxTime();
        $url="https://ju.taobao.com/json/tg/ajaxGetHomeItemsV2.json?type=0&timeFilter=".$filter."&page=".$page."&_ksTS=".$time."_192"."&callback=homelist&timeFilter=todayall";

        //默认
//        if($status==4){
//           $url.="&stype=default";
//        }
//        //销量
//        if($status==5){
//            $url.="&stype=soldCount";
//        }
//        //价格
//        if($status==6){
//            $url.="&stype=activityPrice&reverse=up";
//        }

        $url.="&stype=soldCount";

        $result=HttpUtils::get($url,'',"",'',true,'');
        $result=substr($result,11,strlen($result)-12);
        $list= json_decode($result)->itemList;


        $temp=[];
        for($i=0;$i<count($list);$i++){
            $item=$list[$i];

            $item->baseinfo->picUrl='https:'. $item->baseinfo->picUrl;
            $merits=$item->merit->down;
            if(count($merits)>0){
                $first=$merits[0];

                $t=[
                    strpos($first,"前"),
                    strpos($first,"送"),
                    strpos($first,"第"),
                    strpos($first,"减"),
                    strpos($first,"买"),
                ];

                for($m=0;$m<count($t);$m++){
                    if($t[$m]!==false){
                        array_push($temp,$item);
                        break;
                    }
                }

            }
        }
        return $temp;
    }

    //淘抢购
    public function getTQGbytag($status,$page){
        //默认
        if($status=='1'){
            $type='personalized';
        }
        //销量
        if($status=='2'){
            $type='sales';
        }
        //价格
        if($status=='3'){
            $type='price';
        }
        $pagesize='50';
        $offset=($page-1)*$pagesize;
        $data= '{"orderType":"'.$type.'","offset":'.$offset.',"limit":'.$pagesize.'}';

        $time=DateUtils::getLinuxTime();


        $arr=$this->prepare_tbh5();

        $m_h5_tk=$arr['m_h5_tk'];
        $cookie=$arr['cookie'];
        $sign=$this->calculateTbSign($m_h5_tk,$time,$data);

        $url="https://unszacs.m.taobao.com/h5/mtop.msp.qianggou.queryitembyordertype/1.0/?v=1.0&api=mtop.msp.qianggou.queryItemByOrderType&appKey=12574478&t=".$time."&callback=mtopjsonp3&type=jsonp&sign=".$sign."&data=".urlencode($data);

        $jun = new Jun();
        $cookie=$jun->get_cookie()['data'];

        $result=HttpUtils::get($url,'',$cookie,'',true,'');
        return $result;
        $result=substr($result,12,strlen($result)-13);
        $list= json_decode($result)->data->items;

        return $list;
    }



    //淘抢购
    public function getTQGbytime($timeid,$page){
        //201902091100
        $data= '{"batchId":"'.$timeid.'","page":'.$page.',"pageSize":50}';

        $time=DateUtils::getLinuxTime();

        $arr=$this->prepare_tbh5();

        $m_h5_tk=$arr['m_h5_tk'];
        $cookie=$arr['cookie'];

        $sign=$this->calculateTbSign($m_h5_tk,$time,$data);

        $url="https://unszacs.m.taobao.com/h5/mtop.msp.qianggou.queryitembybatchid/3.3/?v=3.3&api=mtop.msp.qianggou.queryItemByBatchId&appKey=12574478&t=".$time."&callback=mtopjsonp3&type=jsonp&sign=".$sign."&data=".urlencode($data);
        $result=HttpUtils::get($url,'',$cookie,'',true,'');

        $result=substr($result,12,strlen($result)-13);
        $list= json_decode($result)->data->items;

        return $list;
    }

    public function getBanner($goodsid){
        $data=$this->getTBdata($goodsid);


        if(isset($data->trade->redirectUrl)){
            return ['code'=>'10020002','msg'=>"淘宝接口错误"];
        }

        $banners= $data->item->images;
        return $banners;
    }


    public function detail($goodsid){

        $data=$this->getTBdata($goodsid);


        if(isset($data->trade->redirectUrl)){
            return ['code'=>'10020002','msg'=>"淘宝接口错误"];
        }

        $apistack=json_decode($data->apiStack[0]->value)->item;
        $banners= $data->item->images;;

        $seller=$data->seller;

        $data='{"appId":"766","params":"{\"itemid\":\"'.$goodsid.'\"}"}';
        $params=array(
            'data'=>$data,
            'api'=>'mtop.relationrecommend.wirelessrecommend.recommend',
            'v'=>'2.0',
            'appKey'=>'12574478',
            'jsv'=>'2.5.0',
        );
        $data=$this->req_tbh5($params);


        $recommand=[];
        if(isset($data->result)){
           $recommand=$data->result;
        }

        $jun=$this->jundetail($goodsid);
        if(!$jun){
            return ['code'=>'10020003','msg'=>"jun的查详情接口报错"];
        }

//        $cache=\Yii::$app->cache;
//        $data=$cache->get("cnts_".$goodsid);
//        if($data!==false){
//            $pics=$data;
//        }
//        else{
//            $cnts= $this->getdetaildesc($goodsid);
//            $pics=$cnts->wdescContent->pages;
//            $temp=[];
//            for ($i=0;$i<count($pics);$i++){
//
/*                if( preg_match('/<img.?>(.*?)<\/img>/',$pics[$i],$match)){*/
//                    array_push($temp,$match[1]);
//                }
//            }
//
//            $cache->set("cnts_".$goodsid,$temp,3600);
//            $pics=$temp;
//        }
        //$phone=Base::getUserPhone();

        $phone='18658771300';

        $fav=FavGoods::find()
            ->andWhere(['=','goodsid',$goodsid])
            ->andWhere(['=','phone',$phone])
            ->one();
        $is_fav=0;
        if($fav){
            $is_fav=1;
        }

        $data= [
            'jun'=>$jun,
            'banner'=>$banners,
            'seller'=>$seller,
            'apistack'=>$apistack,
            'recommend'=>$recommand,
            'is_fav'=>$is_fav
        ];




        return ['code'=>'0','data'=>$data];



    }
    /*
     * 请求淘宝的基础框架
     * */
    public function req_tbh5($params){

        $arr=$this->prepare_tbh5();

        $m_h5_tk=$arr['m_h5_tk'];
        $cookie=$arr['cookie'];

        $time=DateUtils::getLinuxTime();

        $sign=$this->calculateTbSign($m_h5_tk,$time,$params['data']);

        $url='https://h5api.m.taobao.com/h5/'.$params['api'].'/'.$params['v'].'/?jsv='.$params['jsv'].'&appKey=12574478&t='.$time.'&sign='.$sign.'&api='.$params['api'].'&v='.$params['v'].'&type=jsonp&dataType=jsonp&callback=mtopjsonp&data='.$params['data'];
        $result=HttpUtils::get($url,'',$cookie,'',true,'');


        if(preg_match('/mtopjsonp\((.*)\)/',$result,$match)){
            return json_decode($match[1])->data;
        }
        return false;
    }


    //计算淘宝h5的sign
    public function calculateTbSign($m_h5_tk,$time,$data){
        $appkey='12574478';

        $sign=md5($m_h5_tk.'&'.$time."&".$appkey."&".$data);
        return $sign;
    }
    /*
     * 提供淘宝h5请求的必要参数
     * */
    public function prepare_tbh5(){
        $m_h5_tk='';

        $time=DateUtils::getLinuxTime();

        $appkey='12574478';

        $data='{"containerId":"main","ext":"{\"h5_platform\":\"h5\",\"h5_ttid\":\"60000@taobao_h5_1.0.0\"}"}';

        $sign=md5($m_h5_tk.'&'.$time."&".$appkey."&".$data);


        $url='https://h5api.m.taobao.com/h5/mtop.taobao.wireless.home.load/1.0/?jsv=2.5.0&appKey=12574478&t='.$time.'&sign='.$sign.'&api=mtop.taobao.wireless.home.load&v=1.0&type=jsonp&dataType=jsonp&callback=mtopjsonp2&data='.urlencode($data);

        $result=HttpUtils::get($url,'','','',true,true);
        $header=$result['header'];
        $arr=$this->get_h5tb_token($header);

        return $arr;

    }
    /*
    *  返回 ['cookie'=>'','m_h5_tk'=>'']
    * */
    public function get_h5tb_token($result){

        $cookie='';
        $m_h5_tk='';
        if(preg_match('/_m_h5_tk=(.*?);/',$result,$match)){
            $token=$match[1];
            $arr=explode('_',$token);
            $m_h5_tk=$arr[0];
        }

        if(preg_match('/cookie2=(.*?);/',$result,$match)){
            $cookie.=$match[0];
        }
        if(preg_match('/v=(.*?);/',$result,$match)){
            $cookie.=$match[0];
        }
        if(preg_match('/_tb_token_=(.*?);/',$result,$match)){
            $cookie.=$match[0];
        }

        if(preg_match('/_m_h5_tk=(.*?);/',$result,$match)){
            $cookie.=$match[0];
        }
        if(preg_match('/_m_h5_tk_enc=(.*?);/',$result,$match)){
            $cookie.=$match[0];
        }

        return array('cookie'=>$cookie,'m_h5_tk'=>$m_h5_tk);
    }


    public function jundetail($goodsid){


        //$pid = Pid::getPid();
        if(YII_DEBUG){
            $pid='mm_108262629_38890452_144740472';
        }


        $jun = new Jun();

        $data=$jun->gy_api($goodsid,$pid);

        if (isset($data['error_response'])) {
            return false;
        }

        $form = $jun->create_goods_detail_form($data['tbk_privilege_get_response']['result']['data']);


        return ['data'=>$form];

    }
}