<?php


namespace app\componments\jun;
use app\mdl\goods\jundetail;

class jun  {
    public $server='47.96.23.69';
    public $port='80';
    public $apikey='86553310';
    public $secondkey='8888';

    public $awobaba_server='http://alimama.awobaba.cn:88';




    ///http://www.awobaba.cn/almm-api.html
    /*
     * 通过商品ID获取推广链接
     * */
    public function get_detail($goodsid,$pid){

        $send_data = "api?key=".$this->apikey."&utf=1&getname=link&id=".$goodsid."&pid=".$pid;
        $result=$this->socket_alimama($send_data);

        return $result;
    }

    //淘口令生成接口(官方API) 没限频率
    public function createpwd($url){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=createtpwd&url=".urlencode($url)."&text=".urlencode('铃铛免单商品')."&logo=".urlencode('https://img.alicdn.com/tps/i3/TB1XIwGHFXXXXcBXFXXLZDx_pXX-107-44.png');
        $result=$this->socket_alimama($send_data);

        return $result;
        //http://软件IP:端口/api?Key=连接密钥&getname=createtpwd&url=口令跳转目标页&text=口令弹框内容&logo=
    }

    /*
     * 2,根据商品链接获取转链后的数据
     * */

    public function get_bylink($url,$pid){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=msg&content=".urlencode($url)."&pid=".$pid;
        $result=$this->socket_alimama($send_data);

        return $result;
    }
    /*
     * 3 通过关键词获取,coupon:1 只返回优惠劵商品,0 返回全部
     * */
    public function get_bygoodsname($keyword,$pid){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=search&keyword=" . urlencode ( $keyword ) . "&type=1&coupon=1&pid=".$pid;
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     * 4,根据商品淘口令(解析淘口令)获取数据
     * */
    public function parse_token($token,$pid){
        $send_data = "api?Key=".$this->apikey."&utf=1&getname=taotoken&content=" . urlencode ( $token ) . "&type=1&pid=".$pid;
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     * 订单维权退款
     * 	$refund_type 1 退款订单, 2 第三退款订单, 3 服务费退款订单
     *  $searchType    必须; 1 创建时间, 2结算时间, 3 完成时间
     * */
    public function refund_order($refund_type='1',$search_type='1'){

        $end=date('Y-m-d',time());
        $start=date('Y-m-d',time()-(60*60*24*89));
        $send_data = "api?Key=".$this->apikey."&getname=refundpaydata&refundtype=".$refund_type."&searchtype=".$search_type."&starttime=".urlencode($start)."&endtime=".urlencode($end);
        echo $send_data;
        $result=$this->socket_alimama($send_data);
        return $result;
    }


    public function parse_token_return_goodsid($token,$pid){
        $result=$this->parse_token($token,$pid);


        if(isset($result['errcode'])){
            return 0;
        }
        else{
            return $result['auctionId'];
        }

    }




    public function getGoodsIdByUrl($link){
        $html=$this->http->get($link);
        ssc_common::sendEmail($html);

        $goodsid=0;
        if(preg_match('/&id=(.*?)&/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/\?id=(.*?)&/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/a\.m\.taobao\.com\/i(\d*?)\.htm/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/a\.m\.tmall\.com\/i(\d*?)\.htm/',$html,$match))
        {
            $goodsid=$match[1];
        }
        return $goodsid;
    }

    public function get_goodsid_from_url($link){

        $html=ssc_common::get($link);

        $goodsid=0;
        if(preg_match('/&id=(.*?)&/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/\?id=(.*?)&/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/a\.m\.taobao\.com\/i(\d*?)\.htm/',$html,$match))
        {
            $goodsid=$match[1];
        }
        if(preg_match('/a\.m\.tmall\.com\/i(\d*?)\.htm/',$html,$match))
        {
            $goodsid=$match[1];
        }

    }

    /*
     * 5,获取订单明细接口
     * */

    public function get_allorder(){
        // 获取全部订单,时间范围为软件上设置的.
        $send_data = "api?key=".$this->apikey."&utf=1&getname=dingdan&type=0&id=&status=&start=&end=";
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     * 6 按时间返回获取订单
     * http://软件IP:端口/api?Key=连接密钥&getname=dingdan(第三方订单为:kt3dingdan)&type=0&id=&status=&start=&end=
  参数说明:
  type   获取类型.(0-全部,1-根据订单号获取,2-根据商品ID获取)
  id     如果type是1,2的情况下该参数为订单号或者商品ID,全部订单请留空
  status 状态指定,(12 已付款;11 未付款;13 已过期;3 已结算),不指定请留空
  start  订单范围起始时间,不指定请留空
  end    订单范围结束时间,不指定请留空
例:
(全部订单默认为设置的日期范围)http://127.0.0.1:8886/api?Key=1234567&getname=dingdan&type=0&id=&status=&start=&end=
(根据自定义时间段来获取)http://127.0.0.1:8886/api?Key=1234567&getname=dingdan&type=0&id=&status=&start=2016-10-20&end=2016-12-20
(根据成交的订单ID来获取)http://127.0.0.1:8886/api?Key=1234567&getname=dingdan&type=1&id=2876012693980123&status=&start=&end=
(根据成交的商品ID来获取)http://127.0.0.1:8886/api?Key=1234567&getname=dingdan&type=2&id=525027300079&status=&start=&end=
     *
     * */
    public function get_order_by_time($start,$end){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=dingdan&type=0&id=&status=&start=".$start."&end=".$end;
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    public function get_order_by_time_http($start,$end){

        $server=$this->server;
        $port=$this->port;
        $url="http://".$server.":".$port."/api?key=".$this->apikey."&utf=1&getname=dingdan&type=0&id=&status=&start=".$start."&end=".$end."\"";
        $result=ssc_common::get($url);
        return $result;
    }

    /*
     * 7.根据订单ID来获取订单
     * */

    public function get_order_by_orderid($orderid){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=dingdan&type=1&id=".$orderid."&status=&start=&end=";
        $result=$this->socket_alimama($send_data);
        return $result;
    }
    /*
     * 获得失败订单状态
     * */
    public function get_order_fail($orderid){
        $r=$this->get_order_by_orderid($orderid);
        if(!isset($r['errcode']) )
        {

            $r=$r['dingdan'];


            //订单未付款
            if($r[0]['F9']=='订单失效' && $r[0]['F13']==0)
            {
                $my_fee=0;
                for($i=0;$i<count($r);$i++)
                {
                    $my_fee=$my_fee+(float)$r[$i]['F8']*($r[$i]['F18']/100)*($r[$i]['F12']/100);
                }
                $cus_fee=$this->calculatecommission_forcustomer($my_fee);
                return array('cus_fee'=>$cus_fee,'my_fee'=>$my_fee,'result'=>"success");
            }

        }
        return array('result'=>"fail");

    }
    /*
     * 获得订单的佣金
     * */
    public function get_order_fee($orderid){
        //一个月的
        $r=$this->get_order_by_orderid($orderid);
        if(!isset($r['errcode']))
        {
            $r=$r['dingdan'];
            $my_fee=0;
            for($i=0;$i<count($r);$i++)
            {
                $my_fee=$my_fee+(float)$r[$i]['F14'];
            }
            $cus_fee=$this->calculatecommission_forcustomer($my_fee);
            return array('cus_fee'=>$cus_fee,'my_fee'=>$my_fee,'result'=>"success");
        }

        //数据库的
        $dal_tkuser_order=&ssc_loadclass::model_dal('dal_tkuser_order');
        $result=$dal_tkuser_order->get_list(array('orderid='=>$orderid));
        if(count($result)>0)
        {
            $my_fee=$result[0]->mycommission;
            $cus_fee=$result[0]->cuscommission;
            return array('cus_fee'=>$cus_fee,'my_fee'=>$my_fee,'result'=>"success");
        }

        return array('result'=>"fail",'msg'=>'订单不存在');
    }
    /*
     * 计算给客户的佣金
     * */
    public function calculatecommission_forcustomer($mytkCommFee){

        $customerratenocoupon =  \Yii::$app->params['cus_jiesuan_user'];

        $custkCommFee = 0;
        foreach ($customerratenocoupon as $key => $value) {
            $arr = explode("-", $key);
            $head = $arr[0];
            $tail = $arr[1];

            if (($mytkCommFee >= $head) && ($mytkCommFee <= $tail)) {
                $custkCommFee = $mytkCommFee * $customerratenocoupon[$key];
                $custkCommFee = sprintf("%.2f", $custkCommFee);
            }
        }
        return $custkCommFee;

    }
    /*
     * 计算给代理的佣金
     * */
    public function calculatecommission_forcustomer_agent($cus_fee){
        $app_agent_fee = $this->config->get_config("agent_fee");
        $agent_fee = sprintf("%.2f", ($cus_fee*$app_agent_fee));
        return $agent_fee;
    }

    /*
     * 计算给运营商的佣金
     * */
    public function calculatecommission_forcustomer_yunyingshang($cus_fee){
        $yunyingshang_fee = $this->config->get_config("yunyingshang_fee");
        $yy_fee = sprintf("%.2f", ($cus_fee*$yunyingshang_fee));
        return $yy_fee;
    }



    /*
     * 计算结算给代理的钱
     * */
    public function calfee_for_agent($cusfee){
        $agent_rate = $this->config->get_config("agent_rate");
        return sprintf("%.2f", $cusfee*$agent_rate);
    }



    /*
     * 8. 根据商品ID来获取订单
     * */
    public function get_order_by_goodsid($goodsid){
        $send_data = "api?key=".$this->apikey."&utf=1&getname=dingdan&type=2&id=".$goodsid."&status=&start=&end=";
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     *  9.获得cookie
     * */
    public function get_cookie(){
        $send_data="api?Key=".$this->apikey."&getname=cookie&skey=".$this->secondkey;
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     * 10. 创建广告位
     *
     * : Array ( [data] => Array ( [siteId] => 40228757 [adzoneId] => 153402561 ) [info] => Array ( [message] => [ok] => 1 ) [ok] => 1 [invalidKey] => )
     * */
    public function create_guangaowei($siteid){
        $send_data="api?Key=".$this->apikey."&getname=adzone&type=8&siteid=".$siteid."&adzonename=c5";
        $result=$this->socket_alimama($send_data);
        if($result['ok']!=1)
        {
            ssc_common::sendEmail('创建广告位错误');
            return array('result'=>"fail");
        }
        return array('result'=>'success','site_id'=>$result['data']['siteId'],'adzone_id'=>$result['data']['adzoneId']);
    }

    public function create_pid_dg($siteid){
        $send_data="api?Key=".$this->apikey."&getname=adzone&type=8&siteid=".$siteid."&adzonename=c5";
        $result=$this->socket_alimama($send_data);
        var_dump($result);
        if($result['ok']!=1)
        {
            ssc_common::sendEmail('创建广告位错误');
            return array('result'=>"fail","data"=>$result);
        }
        $memberid="108262629";
        $pid="mm_".$memberid."_".$result['data']['siteId']."_".$result['data']['adzoneId'];
        return array('result'=>'success','siteid'=>$result['data']['siteId'],'adid'=>$result['data']['adzoneId'],"memberid"=>$memberid,"pid"=>$pid);
    }

    //api?Key='.$this->apikey.'&getname=link&id=商品ID/淘口令/商品链接&pid='.$pid;
    //高佣金转链 官方
    public function gy_api($param,$pid){
        //$send_data='api?Key='.$this->apikey.'&getname=link&id=商品ID/淘口令/商品链接&pid='.$pid;
        $send_data='api?Key='.$this->apikey.'&getname=link&id='.urlencode($param) .'&pid='.$pid;
        $result=$this->socket_alimama($send_data);
        return $result;
    }

    /*
     * 11. 通用转链助手
     * */
    public function change_link($url,$pid){
        $send_data="api?Key=".$this->apikey."&getname=linktool&url=".urlencode($url)."&pid=".$pid;
        $result=$this->socket_alimama($send_data);
        return $result;
    }
    /*
     *  12,商品库搜索(列表)
     *  * http://软件IP:端口/api?Key=连接密钥&getname=searchlist&action=类别&data=数据
  参数说明:
  action   1 普通商品库; 2 高佣商品库
  data  为相关参数组合,必须urlencode转码
      q=(关键词,必须urlencode)
      &queryType=(排序; 0 默认,2 人气)
      &sortType=(扩展排序,必须指定上面为0,不需要不写)
            参数可选:3 价格从高到低,4 价格从低到高,5 月推广量,7 月支出佣金从高到低,9 销量
      &toPage=1(分页,必须)
      &perPageSize=50(显示商品数量,必须)
  ===============以下为可选条件,需要加上,不需要不写=============
      &freeShipment=1(包邮)
      &shopTag=yxjh(营销和定向计划)
      &dpyhq=1(优惠券,必须shopTag=dpyhq)
      &hPayRate30=1(月成交转化率高于行业均值)
      &b2c=1&shopTag=b2c(天猫旗舰店)
      &startBiz30day=50(月销量多少)
      &startTkRate=1(比率范围起)&endTkRate=20(比率范围终)
      &startPrice=32(价格范围起)&endPrice=97(价格范围终)
      &loc=重庆(发货地,必须urlencode)
排序_des（降序），排序_asc（升序），销量（total_sales），淘客佣金比率（tk_rate）， 累计推广量（tk_total_sales），总支出佣金（tk_total_commi），价格（price）
    http://软件IP:端口/api?Key=连接密钥&getname=list&adzone_id=推广位ID&q=关键字
     * */
    public function get_goodslist($kw,$page,$sort,$hasCoupon){
        $ad_id='76292354';


        $send_data="api?Key=".$this->apikey."&getname=list&adzone_id=".$ad_id."&q=".urlencode($kw).'&page_no='.$page."&has_coupon=".$hasCoupon."&sort=".$sort;
        $result=$this->socket_alimama($send_data);
        return $result;
    }


    /**
     * socket方式获取
     *
     * @param unknown $server
     * @param unknown $port
     * @param unknown $send_data
     * @return NULL|mixed
     */
    function socket_alimama($send_data) {
        $server=$this->server;
        $port=$this->port;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP );
        if ($socket < 0) {
            return "socket 错误: " . socket_strerror ( $socket );
        }
        $result = socket_connect ( $socket, $server, $port );
        if ($result < 0) {
            return "socket 错误: ($result) " . socket_strerror ( $result );
        }
        $output = '';
        $header = 'GET /' . $send_data . ' HTTP/1.1';
        socket_write ( $socket, $header, strlen ( $header ) );
        while ( $out = socket_read ( $socket, 40960 ) ) {
            $output .= substr ( $out, strpos ( $out, "\r\n\r\n" ) );
        }
        socket_close ( $socket );
        if (strpos ( $output, "提示:" ) > 0) { // 如果包含提示就输出提示,这里可以替换成自己的提示
            return null;
        }

        $result=json_decode ( $output, true );

        $this->wrong_yanzhenma($result);
        return $result;
    }

    public function wrong_yanzhenma($result){
        if(isset($result['errcode']) && $result['errcode']==40002){
            ssc_common::sendEmail("jun获得验证码错误");
        }
    }

    /*
     * 获得订单数据
     * */
    public function get_orderdata_by_orderid($orderid){
        $result=$this->get_order_by_orderid($orderid);

        if(isset($result['errcode']) && $result['errcode']==20009)
        {
            return array('code'=>'10051','msg'=>"未找到该订单,使用了红包或者长时间加入购物车之后才购物无返利");
        }
        return array('code'=>'0','msg'=>'ok','data'=>$result['dingdan']);
    }
    /*
     *  创建一个订单号的表单模型
     * */
    public function create_order_form($order_data){
        $arr=array();

        for($i=0;$i<count($order_data);$i++){
            $mdl_tkuser_junorderform=&ssc_loadclass::model('mdl_tkuser_junorderform');

            //淘客订单状态，3：订单结算，12：订单付款， 13：订单失效，14：订单成功
            $status_msg='';
            switch ($order_data[$i]['tk_status']){
                case 3:
                    $status_msg='订单结算';
                    break;
                case 12:
                    $status_msg='订单付款';
                    break;
                case 13:
                    $status_msg='订单失效';
                    break;
                case 14:
                    $status_msg='订单成功';
                    break;
                default:
                    $status_msg="未知状态";
            }

            $real_pay=$order_data[$i]['alipay_total_price'];
            $myfee=$order_data[$i]['income_rate']*$real_pay;
            $cusfee=$this->calculatecommission_forcustomer($myfee);

            $mdl_tkuser_junorderform->ad_id=$order_data[$i]['adzone_id'];
            $mdl_tkuser_junorderform->create_time=$order_data[$i]['create_time'];
            $mdl_tkuser_junorderform->confirm_time=isset($order_data[$i]['earning_time']) ? $order_data[$i]['earning_time']:'';
            $mdl_tkuser_junorderform->goods_id=$order_data[$i]['num_iid'];
            $mdl_tkuser_junorderform->item_num=$order_data[$i]['item_num'];
            $mdl_tkuser_junorderform->tk_status=$status_msg;
            $mdl_tkuser_junorderform->item_title=$order_data[$i]['item_title'];
            $mdl_tkuser_junorderform->single_price=$order_data[$i]['price'];
            $mdl_tkuser_junorderform->real_pay_money=$real_pay;
            $mdl_tkuser_junorderform->myfee=$myfee;
            $mdl_tkuser_junorderform->cusfee=$cusfee;
            $mdl_tkuser_junorderform->site_id=$order_data[$i]['site_id'];
            $mdl_tkuser_junorderform->site_id=$order_data[$i]['site_id'];
            $mdl_tkuser_junorderform->rate=$order_data[$i]['income_rate'];
            $mdl_tkuser_junorderform->c_orderid=$order_data[$i]['trade_id'];
            $mdl_tkuser_junorderform->p_orderid=$order_data[$i]['trade_parent_id'];

            array_push($arr,$mdl_tkuser_junorderform);
        }

        return $arr;
    }
    /*
     * 创建维权表单的数据
     * */
    public function create_refund_order_form($_refund_order_data){
        $arr=array();
        foreach($_refund_order_data as $k=>$v){
            $mdl_tkuser_junrefundorderform=&ssc_loadclass::model('mdl_tkuser_junrefundorderform');
            $mdl_tkuser_junrefundorderform->order_id=$v['F1'];
            $mdl_tkuser_junrefundorderform->small_order_id=$v['F2'];
            $mdl_tkuser_junrefundorderform->goods_content=$v['F3'];
            $mdl_tkuser_junrefundorderform->return_to_shopper=$v['F4'];
            $mdl_tkuser_junrefundorderform->return_to_mama=$v['F5'];
            $mdl_tkuser_junrefundorderform->status=$v['F6'];
            $mdl_tkuser_junrefundorderform->confirm_time=$v['F7'];
            $mdl_tkuser_junrefundorderform->refund_create_time=$v['F8'];
            $mdl_tkuser_junrefundorderform->refund_finished_time=$v['F9'];
            array_push($arr,$mdl_tkuser_junrefundorderform);
        }
        return $arr;
    }


    /*
     * 创建淘客商品详情的表单
     * */
    public function create_goods_detail_form($data){

        $mdl=new jundetail();

        $d=$data;

        $myfee= ($d['zkPrice']-$d['couponAmount'])*($d['tkRate']/100);
        $cusfee=$this->calculatecommission_forcustomer($myfee);

        $mdl->setAuctionTitle($d['auctionTitle']);
        $mdl->setAuctionid($d['auctionId']);
        $mdl->setOriginprice($d['zkPrice']);
        $mdl->setCouponAmount($d['couponAmount']);
        $mdl->setAfterprice($d['zkPrice']-$d['couponAmount']);
        $mdl->setPictUrl($d['pictUrl']);
        $mdl->setVolume($d['volume']);
        $mdl->setTkRate($d['tkRate']);
        $mdl->setAuctionUrl(isset($d['auctionUrl'])?$d['auctionUrl']:'');
        $mdl->setTaoToken($d['taoToken']);
        $mdl->setMyfee($myfee);
        $mdl->setCusfee($cusfee);


        return $mdl;
    }

    //微信回复的消息格式
    public function create_wx_goods_detail_response($form){
        $content =  "【商品标题】:" . $form->auctionTitle . "\r【原价】:" . $form->originprice   . "\r【券后价】:" . $form->afterprice  . "\r【分享赚】:".$form->cusfee."\r【淘口令】:" . $form->taoToken ."\r【操作方法】:〖必须复制这条信息,打开[手机淘宝]即可领券并下单〗";//.\r[玫瑰]若出现打开淘宝app没弹出消息,请点击下方链接".$form->auctionUrl.",下单[玫瑰]\r------点击菜单福利中心->拉新赚钱,有惊喜哦~~";

        return $content;
    }

    //订单获得（无需登录）
    public function order_api($page,$order_query,$start_time=''){

        if($order_query==1){
            $query='create_time';
        }
        if($order_query==2){
            $query='settle_time';
        }
        if(empty($start_time)){
            $start_time=date('Y-m-d H:i:s',time()-1200);
        }

        $params='trade_id,num_iid,create_time,price,pay_price,earning_time,commission_rate,site_id,adzone_id,item_num,tk_status,item_title';
        $send_data='api?Key='.$this->apikey.'&getname=order&span=1200&fields='.$params.'&start_time='.urlencode($start_time).'&page_no='.$page.'&page_size=100&tk_status=1&order_query_type='.$query;
        $result=$this->socket_alimama($send_data);
        return $result;
    }


    //不用登陆获得商品详情，但是需要授权下
    public function get_goods_no_login($goodsid,$pid){
        $url=$this->awobaba_server.'/api=link&item_id='.$goodsid.'&pid='.$pid;
        return $this->get_api_alimama($url);
    }


    public function get_order_no_login(){
        $member_id='108262629';//你的账户ID,授权过的
        //下面这些参数参考文档
        $fields='tb_trade_parent_id,tb_trade_id,num_iid,item_title,item_num,tk_status,price,pay_price,seller_nick,seller_shop_title,commission,commission_rate,unid,create_time,earning_time,tk3rd_pub_id,tk3rd_site_id,tk3rd_adzone_id,relation_id';
        $start_time=date('Y-m-d H:i:s',time()-1200);
        $span='1200';
        $url=$this->awobaba_server.'/api=order&fields='.$fields.'&start_time='.$start_time.'&span='.$span.'&member_id='.$member_id;
        return $this->get_api_alimama($url);

    }

    /**
     * CURL方式获取 (能获取301跳转后)
     *
     * @param unknown $server
     * @param unknown $send_data
     * @return mixed
     */
    public function get_api_alimama($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);//加上这才能获取跳转后的
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); //超时时间,自行按情况而定
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
/* End of file class_input.php */