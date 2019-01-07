<?php


namespace app\componments\zfbtransfer;

use app\componments\utils\HttpUtils;

/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2019/1/7
 * Time: 15:21
 */

class Transfer
{
    public $appId='2019010462799135';
    public $publickey='MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA5VMFu/+8JT+/gb2+Ljele6pDhnTrgniGDOzCSTdWry8B/8Qdg+SRWQ6eKAvqgyapQkWYVP1HpJR6lhiUWUs+RwygNOpvk/EaR7kk/1sDhw+Xrar2uROdvkkp29wQx8vHeY5LafHEfTqxqgc3o1f5UpTrTXgsvX2IWCxoKMDkEN1dAYBuFsM6N9+aAjfAWgSoEMveUszyE+4LbsFNEf76oVOifzTPLQTQ4m0G59Ycpoh4q3+GkuGO5OWX2NYHZzk4a0TIzX3enLQ6urZFLbuPgoNScbQ5o3xXjowTv6QNnA0P4jmUeiPAdQ2VkrHJ+NdoauN8lCqyTyKw7RegnBOVKwIDAQAB';

    public $privatekey="MIIEowIBAAKCAQEA5VMFu/+8JT+/gb2+Ljele6pDhnTrgniGDOzCSTdWry8B/8Qdg+SRWQ6eKAvqgyapQkWYVP1HpJR6lhiUWUs+RwygNOpvk/EaR7kk/1sDhw+Xrar2uROdvkkp29wQx8vHeY5LafHEfTqxqgc3o1f5UpTrTXgsvX2IWCxoKMDkEN1dAYBuFsM6N9+aAjfAWgSoEMveUszyE+4LbsFNEf76oVOifzTPLQTQ4m0G59Ycpoh4q3+GkuGO5OWX2NYHZzk4a0TIzX3enLQ6urZFLbuPgoNScbQ5o3xXjowTv6QNnA0P4jmUeiPAdQ2VkrHJ+NdoauN8lCqyTyKw7RegnBOVKwIDAQABAoIBACtNVPzd2lISSoAeKwYhHc9PJDcEZuAZD/7qyfj3SRgFQVRhXM1l4Ig3eWfIcDzZlQZdi9kohlmua8Nh2slNqvHRkYLMbcs6sKKwdCr/rZfYOuThLnteF+AxgoTwdf60HPN4Cgd0TozzA08+06O1Xe/ZDOFw+snBJXi40eY4HhiMyI381mqU4OeW/43Ve9zSaqKTFQH8sfzP24RbWlzXAzepSut9NukI/ZQsvkaRKp+cJCNX5BTjzs0hGcISLwPu0tOA5TPNTCSjpaSxVssEDc7EBDtoN/1xUxqmjY/btP/eKzvVZdfw2vw6C8nLC/8xP/HDzzyvzVRnarmfUQQuHukCgYEA+yW4CSjOdx2v07CtF8ryP1r5T/IyviPRVC0SkxQt88GU2zkiWzgwf7M8bxSNhEmmDzz5owQ1uiAffbthMYQV8pnPCsLSiql0Jh7vbeRmIKP/e8y5+AE7kzczb0b02cpX2aKnk46YMzREuCJcNqn411MJ+wMd+MhPdfBgQUHGZH8CgYEA6cFbiBapaRWDbe1QHvGJHxtG2H85nc2G5Q2Imz8t45bFp7XHRMOzOeMzReYewysodnmhmbr8GkHT9uxThyFDh05aMYrwLMqQRxPSrzq2FfX09Ez3X2jB90CJJhY64hLOUtuzpanO+MgeEurtlj2ciA19mCV6KGy5OW9SGNd0SVUCgYEAhNJ59j4ik1Sb/LTflkm6vE78s48/ztdaic4cmLR/aP7kHtykkuGwpJjCSWzxOxlIPZ7d150OXRVIElLbIDje8qLtoJ9Qgg0EZHTP46p7aJ/TKkInyEW+oCj9hshcDiK5O1yOi7dKPypRfaCObEqQVDCSgrIvU7d8br9l6J1EszkCgYB7P+s+DwzWDnTU8iqrlhkBoMUzA6nibWqxvPgJOz+731RqQCtIM5N9czEmqtYPe+MCzNELGI8yXQEhEaxc9IoBfquJscM/KrL19xrAL8mwPJYida58zORwtMNbpJ75cob9I0BOmgE6JXHN8bbB38x34/0TyrblN6ZWBT8ZQAjdXQKBgFeGGBjrEO2/3X2kk1yWl3fVyAkyAZaD415k+stbe/SiQQ3+EoUoMaPTeUeKkAEaq3Uu3UdXezLskyGhHNSs5eaztGD4KeJwuWlqQ2tFT5U678/UPsDTLlwsv20hz3KB10FxJbwbU4YeOy7EAAc0zeHsOCzg7dLkz5KhQLurF8cL";


    public $url='https://openapi.alipay.com/gateway.do';

    public $postCharset='utf-8';

    public $fileCharset ;
    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param string $appId
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getPublickey()
    {
        return $this->publickey;
    }

    /**
     * @param string $publickey
     */
    public function setPublickey($publickey)
    {
        $this->publickey = $publickey;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPrivatekey()
    {

        return $this->privatekey;
        return "-----BEGIN RSA PRIVATE KEY-----\n".$this->privatekey."-----END RSA PRIVATE KEY-----\n";

    }

    /**
     * @param string $privatekey
     */
    public function setPrivatekey($privatekey)
    {
        $this->privatekey = $privatekey;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }


    public function transfer($payee_account,$money){
        $method='alipay.fund.trans.toaccount.transfer';
        $appid=$this->getAppId();
        $charset='utf-8';
        $sign_type='RSA2';
        $time=$this->getTimestamp();
        $version='1.0';
        $biz_content='{"out_biz_no":"321341","payee_type","ALIPAY_LOGONID",“payee_account”:"'.$payee_account.'",“amount”:"'.$money.'"}';

        $data=array(
            'method'=> $method,
            'app_id'=>$appid,
            'charset'=>$charset,
            'sign_type'=>$sign_type,
            'timestamp'=>$time,
            'version'=>$version,
            'biz_content'=> urlencode($biz_content),

        );

        $sign=$this->makesign($data);
        var_dump($sign);
        $data['sign']=$sign;
  		$headers = ['content-type: application/x-www-form-urlencoded;charset=utf-8'];


        $ret=$this->curl($this->getUrl(),$data);
        return $ret;
    }


    protected function curl($url, $postFields = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $postBodyString = "";
        $encodeArray = Array();
        $postMultipart = false;


        if (is_array($postFields) && 0 < count($postFields)) {



            curl_setopt($ch, CURLOPT_POST, true);
            if ($postMultipart) {
                //<form id='alipaysubmit' name='alipaysubmit' action='https://openapi.alipay.com/gateway.do?charset=utf-8' method='POST'><input type='hidden' name='app_id' value='2018051460106561'/> <input type='hidden' name='method' value='alipay.trade.page.pay'/> <input type='hidden' name='alipay_sdk' value='alipay-sdk-php-20161101'/> <input type='hidden' name='format' value='json'/> <input type='hidden' name='return_url' value='http://www.woguang.com/index.php/cms/Payment/returnUrl.html'/> <input type='hidden' name='charset' value='UTF-8'/> <input type='hidden' name='sign_type' value='RSA2'/> <input type='hidden' name='timestamp' value='2018-05-15 18:16:53'/> <input type='hidden' name='version' value='1.0'/> <input type='hidden' name='notify_url' value='http://www.woguang.com/index.php/cms/Payment/notifyUrl.html'/> <input type='hidden' name='biz_content' value='{"product_code":"FAST_INSTANT_TRADE_PAY","body":null,"subject":"测试","total_amount":"0.01","out_trade_no":"201805151816539999999999999"}'/> <input type='hidden' name='sign' value='fjV%2BjAWOCc8SMaggWh0gVfgwzRGwENrI3e8uuUob%2Bnl2fz2BwhPwxOmqjd%2BPEN8oy1VQCwL1nwmZBG6MeZ72rkcUNj%2FBz%2Fq6kIRS7z1%2BUhShvFdINMiUgLq3Ip9INLDumo0NeiYJd%2FrZEiy6cvfQ3Pj61BOr9SGLvIKWN676oGoLHNbh7FWghzpO7HZUXW8KfIKem1N4i1OglYBnVBLhv85itMywukI9SRNZNNWSMCa17R%2BXuY6n8r3Hyur4dGT0z6hGHm22fYBmtYXf5Y92pCbdKVZZBvAkI08b9S%2BN%2FR5SU%2FW3cbNNgpyyiTbE3kP4frvsfDz5QP%2FvjqMJvQi%2BYA%3D%3D'/> <input type='submit' value='ok' style='display:none;''> <script>document.forms['alipaysubmit'].submit();</script> </form>
                $form="<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'https://openapi.alipay.com/gateway.do?charset=utf-8\' method=\'POST\'><input type=\'hidden\' name=\'app_id\' value=\'".$postFields['app_id']."\'/> <input type=\'hidden\' name=\'method\' value=\'".$postFields['method']."\'/><input type=\'hidden\' name=\'charset\' value=\'UTF-8\'/> <input type=\'hidden\' name=\'sign_type\' value=\'RSA2\'/> <input type=\'hidden\' name=\'timestamp\' value=\'".$postFields['timestamp']."\'/> <input type=\'hidden\' name=\'version\' value=\'1.0\'/>  <input type=\'hidden\' name=\'biz_content\' value=\'".$postFields['biz_content']."\'/> <input type=\'hidden\' name=\'sign\' value=\'".$postFields['sign']."\'/> <input type=\'submit\' value=\'ok\' style=\'display:none;\'\'> <script>document.forms[\'alipaysubmit\'].submit();</script> </form>";
                curl_setopt($ch, CURLOPT_POSTFIELDS, $form);
            } else {
                //<form id='alipaysubmit' name='alipaysubmit' action='https://openapi.alipay.com/gateway.do?charset=utf-8' method='POST'><input type='hidden' name='app_id' value='2018051460106561'/> <input type='hidden' name='method' value='alipay.trade.page.pay'/> <input type='hidden' name='alipay_sdk' value='alipay-sdk-php-20161101'/> <input type='hidden' name='format' value='json'/> <input type='hidden' name='return_url' value='http://www.woguang.com/index.php/cms/Payment/returnUrl.html'/> <input type='hidden' name='charset' value='UTF-8'/> <input type='hidden' name='sign_type' value='RSA2'/> <input type='hidden' name='timestamp' value='2018-05-15 18:16:53'/> <input type='hidden' name='version' value='1.0'/> <input type='hidden' name='notify_url' value='http://www.woguang.com/index.php/cms/Payment/notifyUrl.html'/> <input type='hidden' name='biz_content' value='{"product_code":"FAST_INSTANT_TRADE_PAY","body":null,"subject":"测试","total_amount":"0.01","out_trade_no":"201805151816539999999999999"}'/> <input type='hidden' name='sign' value='fjV%2BjAWOCc8SMaggWh0gVfgwzRGwENrI3e8uuUob%2Bnl2fz2BwhPwxOmqjd%2BPEN8oy1VQCwL1nwmZBG6MeZ72rkcUNj%2FBz%2Fq6kIRS7z1%2BUhShvFdINMiUgLq3Ip9INLDumo0NeiYJd%2FrZEiy6cvfQ3Pj61BOr9SGLvIKWN676oGoLHNbh7FWghzpO7HZUXW8KfIKem1N4i1OglYBnVBLhv85itMywukI9SRNZNNWSMCa17R%2BXuY6n8r3Hyur4dGT0z6hGHm22fYBmtYXf5Y92pCbdKVZZBvAkI08b9S%2BN%2FR5SU%2FW3cbNNgpyyiTbE3kP4frvsfDz5QP%2FvjqMJvQi%2BYA%3D%3D'/> <input type='submit' value='ok' style='display:none;''> <script>document.forms['alipaysubmit'].submit();</script> </form>
                $form="<form id=\'alipaysubmit\' name=\'alipaysubmit\' action=\'https://openapi.alipay.com/gateway.do?charset=utf-8\' method=\'POST\'><input type=\'hidden\' name=\'app_id\' value=\'".$postFields['app_id']."\'/> <input type=\'hidden\' name=\'method\' value=\'".$postFields['method']."\'/><input type=\'hidden\' name=\'charset\' value=\'UTF-8\'/> <input type=\'hidden\' name=\'sign_type\' value=\'RSA2\'/> <input type=\'hidden\' name=\'timestamp\' value=\'".$postFields['timestamp']."\'/> <input type=\'hidden\' name=\'version\' value=\'1.0\'/>  <input type=\'hidden\' name=\'biz_content\' value=\'".$postFields['biz_content']."\'/> <input type=\'hidden\' name=\'sign\' value=\'".$postFields['sign']."\'/> <input type=\'submit\' value=\'ok\' style=\'display:none;\'\'> <script>document.forms[\'alipaysubmit\'].submit();</script> </form>";

                curl_setopt($ch, CURLOPT_POSTFIELDS, $form);
            }

        }

        if ($postMultipart) {

            $headers = array('content-type: multipart/form-data;charset=' . $this->postCharset . ';boundary=' . $this->getMillisecond());
        } else {

            $headers = array('content-type: application/x-www-form-urlencoded;charset=' . $this->postCharset);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);



        $reponse = curl_exec($ch);

        if (curl_errno($ch)) {

            throw new Exception(curl_error($ch), 0);
        } else {
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            if (200 !== $httpStatusCode) {
                throw new Exception($reponse, $httpStatusCode);
            }
        }

        curl_close($ch);
        return $reponse;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {

//        if (!empty($data)) {
//            $fileType = $this->fileCharset;
//            if (strcasecmp($fileType, $targetCharset) != 0) {
//                $data = mb_convert_encoding($data, $targetCharset, $fileType);
//                //				$data = iconv($fileType, $targetCharset.'//IGNORE', $data);
//            }
//        }


        return $data;
    }
    protected function getMillisecond() {
        list($s1, $s2) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
    }



    public function getTimestamp(){
      //  return '2019-01-01 11:11:11';
        return date('Y-m-d H:i:s') ;
        return  date("Y-m-d H:i:s",time());
    }

    public function makesign($data){
        ksort($data);
        $str='';
        foreach ($data as $k=>$v){
            $str.=$k.'='.$v.'&';
        }
        $d=substr($str,0,strlen($str)-1);


        var_dump($d);

        // 私钥密码
        $passphrase = '';
        $key_width = 64;

        //私钥
        $privateKey = $this -> getPrivatekey();
        $p_key = array();
        //如果私钥是 1行
        if( ! stripos( $privateKey, "\n" )  ){
            $i = 0;
            while( $key_str = substr( $privateKey , $i * $key_width , $key_width) ){
                $p_key[] = $key_str;
                $i ++ ;
            }
        }else{
            //echo '一行？';
        }
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n" . implode("\n", $p_key) ;
        $privateKey = $privateKey ."\n-----END RSA PRIVATE KEY-----";


        //私钥
        $private_id = openssl_pkey_get_private( $privateKey , $passphrase);



        // 签名
        $signature = '';
       // openssl_free_key( $private_id );


        openssl_sign($d, $signature, $private_id, OPENSSL_ALGO_SHA256 );


        //加密后的内容通常含有特殊字符，需要编码转换下
        $signature = base64_encode($signature);

        $signature = urlencode( $signature );
        return $signature;
    }

}