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
use app\models\tkuser\Pid;

class H5
{



    public function detail($goodsid){


        $data= urlencode( '{"itemNumId":"'.$goodsid.'","exParams":"{\"id\":\"'.$goodsid.'\",\"scm\":\"1007.14551.117283.0\",\"pvid\":\"4822a42a-bec9-43c2-9e5c-892b5ff51541\",\"track_params\":\"{\\\"mtx_ab\\\":\\\"1\\\",\\\"mtx_sab\\\":\\\"3\\\"}\",\"spm\":\"a215s.7406091.guessitem.guessitem-9\",\"locate\":\"guessitem-item\",\"rmdChannelCode\":\"guessULike\",\"utparam\":\"{\\\"x_object_type\\\":\\\"item\\\",\\\"mtx_ab\\\":1,\\\"mtx_sab\\\":3,\\\"scm\\\":\\\"1007.14551.117283.0\\\",\\\"x_object_id\\\":38624360220}\"}","detail_v":"3.1.1","ttid":"2018@taobao_iphone_9.9.9","utdid":"123123123123123"}');

        $params=array(
            'data'=>$data,
            'api'=>'mtop.taobao.detail.getdetail',
            'v'=>'6.0',
            'appKey'=>'12574478',
            'jsv'=>'2.5.0',
        );

        $data=$this->req_tbh5($params);


        if(isset($data->trade->redirectUrl)){
            return ['code'=>'10020002','msg'=>"淘宝接口错误"];
        }

        $apistack=json_decode($data->apiStack[0]->value)->item;
        $banners=$data->item;

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
//        if(!$jun){
//            return ['code'=>'10020003','msg'=>"jun的查详情接口报错"];
//        }

        $data= [
            'jun'=>$jun,
            'banner'=>$banners,
            'seller'=>$seller,
            'apistack'=>$apistack,
            'recommend'=>$recommand,
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

        $pid = Pid::getPid();
        $jun = new Jun();

        $data=$jun->gy_api($goodsid,$pid);

        if (isset($data['error_response'])) {
            return false;
        }

        $form = $jun->create_goods_detail_form($data['tbk_privilege_get_response']['result']['data']);


        return ['data'=>$form];

    }
}