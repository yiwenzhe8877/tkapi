<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2019/1/7
 * Time: 17:03
 */
namespace app\componments\zfbtransfer;

class Base extends RSA
{
    /**
     * 以下信息需要根据自己实际情况修改
     */
//自己的私钥

    //自己的私钥
    const APPPRIKEY = 'MIIEowIBAAKCAQEA5VMFu/+8JT+/gb2+Ljele6pDhnTrgniGDOzCSTdWry8B/8Qdg+SRWQ6eKAvqgyapQkWYVP1HpJR6lhiUWUs+RwygNOpvk/EaR7kk/1sDhw+Xrar2uROdvkkp29wQx8vHeY5LafHEfTqxqgc3o1f5UpTrTXgsvX2IWCxoKMDkEN1dAYBuFsM6N9+aAjfAWgSoEMveUszyE+4LbsFNEf76oVOifzTPLQTQ4m0G59Ycpoh4q3+GkuGO5OWX2NYHZzk4a0TIzX3enLQ6urZFLbuPgoNScbQ5o3xXjowTv6QNnA0P4jmUeiPAdQ2VkrHJ+NdoauN8lCqyTyKw7RegnBOVKwIDAQABAoIBACtNVPzd2lISSoAeKwYhHc9PJDcEZuAZD/7qyfj3SRgFQVRhXM1l4Ig3eWfIcDzZlQZdi9kohlmua8Nh2slNqvHRkYLMbcs6sKKwdCr/rZfYOuThLnteF+AxgoTwdf60HPN4Cgd0TozzA08+06O1Xe/ZDOFw+snBJXi40eY4HhiMyI381mqU4OeW/43Ve9zSaqKTFQH8sfzP24RbWlzXAzepSut9NukI/ZQsvkaRKp+cJCNX5BTjzs0hGcISLwPu0tOA5TPNTCSjpaSxVssEDc7EBDtoN/1xUxqmjY/btP/eKzvVZdfw2vw6C8nLC/8xP/HDzzyvzVRnarmfUQQuHukCgYEA+yW4CSjOdx2v07CtF8ryP1r5T/IyviPRVC0SkxQt88GU2zkiWzgwf7M8bxSNhEmmDzz5owQ1uiAffbthMYQV8pnPCsLSiql0Jh7vbeRmIKP/e8y5+AE7kzczb0b02cpX2aKnk46YMzREuCJcNqn411MJ+wMd+MhPdfBgQUHGZH8CgYEA6cFbiBapaRWDbe1QHvGJHxtG2H85nc2G5Q2Imz8t45bFp7XHRMOzOeMzReYewysodnmhmbr8GkHT9uxThyFDh05aMYrwLMqQRxPSrzq2FfX09Ez3X2jB90CJJhY64hLOUtuzpanO+MgeEurtlj2ciA19mCV6KGy5OW9SGNd0SVUCgYEAhNJ59j4ik1Sb/LTflkm6vE78s48/ztdaic4cmLR/aP7kHtykkuGwpJjCSWzxOxlIPZ7d150OXRVIElLbIDje8qLtoJ9Qgg0EZHTP46p7aJ/TKkInyEW+oCj9hshcDiK5O1yOi7dKPypRfaCObEqQVDCSgrIvU7d8br9l6J1EszkCgYB7P+s+DwzWDnTU8iqrlhkBoMUzA6nibWqxvPgJOz+731RqQCtIM5N9czEmqtYPe+MCzNELGI8yXQEhEaxc9IoBfquJscM/KrL19xrAL8mwPJYida58zORwtMNbpJ75cob9I0BOmgE6JXHN8bbB38x34/0TyrblN6ZWBT8ZQAjdXQKBgFeGGBjrEO2/3X2kk1yWl3fVyAkyAZaD415k+stbe/SiQQ3+EoUoMaPTeUeKkAEaq3Uu3UdXezLskyGhHNSs5eaztGD4KeJwuWlqQ2tFT5U678/UPsDTLlwsv20hz3KB10FxJbwbU4YeOy7EAAc0zeHsOCzg7dLkz5KhQLurF8cL'; //修改成自己的 应用私钥
//申请到的APPID
    const APPID = '2019010462799135';
//支付宝公钥，不是你自己生成的公钥
    const NEW_ALIPUBKE ='MIIEowIBAAKCAQEA5VMFu/+8JT+/gb2+Ljele6pDhnTrgniGDOzCSTdWry8B/8Qdg+SRWQ6eKAvqgyapQkWYVP1HpJR6lhiUWUs+RwygNOpvk/EaR7kk/1sDhw+Xrar2uROdvkkp29wQx8vHeY5LafHEfTqxqgc3o1f5UpTrTXgsvX2IWCxoKMDkEN1dAYBuFsM6N9+aAjfAWgSoEMveUszyE+4LbsFNEf76oVOifzTPLQTQ4m0G59Ycpoh4q3+GkuGO5OWX2NYHZzk4a0TIzX3enLQ6urZFLbuPgoNScbQ5o3xXjowTv6QNnA0P4jmUeiPAdQ2VkrHJ+NdoauN8lCqyTyKw7RegnBOVKwIDAQABAoIBACtNVPzd2lISSoAeKwYhHc9PJDcEZuAZD/7qyfj3SRgFQVRhXM1l4Ig3eWfIcDzZlQZdi9kohlmua8Nh2slNqvHRkYLMbcs6sKKwdCr/rZfYOuThLnteF+AxgoTwdf60HPN4Cgd0TozzA08+06O1Xe/ZDOFw+snBJXi40eY4HhiMyI381mqU4OeW/43Ve9zSaqKTFQH8sfzP24RbWlzXAzepSut9NukI/ZQsvkaRKp+cJCNX5BTjzs0hGcISLwPu0tOA5TPNTCSjpaSxVssEDc7EBDtoN/1xUxqmjY/btP/eKzvVZdfw2vw6C8nLC/8xP/HDzzyvzVRnarmfUQQuHukCgYEA+yW4CSjOdx2v07CtF8ryP1r5T/IyviPRVC0SkxQt88GU2zkiWzgwf7M8bxSNhEmmDzz5owQ1uiAffbthMYQV8pnPCsLSiql0Jh7vbeRmIKP/e8y5+AE7kzczb0b02cpX2aKnk46YMzREuCJcNqn411MJ+wMd+MhPdfBgQUHGZH8CgYEA6cFbiBapaRWDbe1QHvGJHxtG2H85nc2G5Q2Imz8t45bFp7XHRMOzOeMzReYewysodnmhmbr8GkHT9uxThyFDh05aMYrwLMqQRxPSrzq2FfX09Ez3X2jB90CJJhY64hLOUtuzpanO+MgeEurtlj2ciA19mCV6KGy5OW9SGNd0SVUCgYEAhNJ59j4ik1Sb/LTflkm6vE78s48/ztdaic4cmLR/aP7kHtykkuGwpJjCSWzxOxlIPZ7d150OXRVIElLbIDje8qLtoJ9Qgg0EZHTP46p7aJ/TKkInyEW+oCj9hshcDiK5O1yOi7dKPypRfaCObEqQVDCSgrIvU7d8br9l6J1EszkCgYB7P+s+DwzWDnTU8iqrlhkBoMUzA6nibWqxvPgJOz+731RqQCtIM5N9czEmqtYPe+MCzNELGI8yXQEhEaxc9IoBfquJscM/KrL19xrAL8mwPJYida58zORwtMNbpJ75cob9I0BOmgE6JXHN8bbB38x34/0TyrblN6ZWBT8ZQAjdXQKBgFeGGBjrEO2/3X2kk1yWl3fVyAkyAZaD415k+stbe/SiQQ3+EoUoMaPTeUeKkAEaq3Uu3UdXezLskyGhHNSs5eaztGD4KeJwuWlqQ2tFT5U678/UPsDTLlwsv20hz3KB10FxJbwbU4YeOy7EAAc0zeHsOCzg7dLkz5KhQLurF8cL'; //修改成自己的 支付宝公钥


    public function getStr($arr,$type = 'RSA'){
        //筛选
        if(isset($arr['sign'])){
            unset($arr['sign']);
        }
        if(isset($arr['sign_type']) && $type == 'RSA'){
            unset($arr['sign_type']);
        }
        //排序
        ksort($arr);
        //拼接
        return  $this->getUrl($arr,false);
    }
//将数组转换为url格式的字符串
    public function getUrl($arr,$encode = true){
        if($encode){
            return http_build_query($arr);
        }else{
            return urldecode(http_build_query($arr));
        }
    }

//获取签名RSA2
    public function getRsa2Sign($arr){
        return $this->rsaSign($this->getStr($arr,'RSA2'), self::APPPRIKEY,'RSA2') ;
    }
//获取含有签名的数组RSA
    public function setRsa2Sign($arr){
        $arr['sign'] = $this->getRsa2Sign($arr);
        return $arr;
    }
    public function checkSign($arr){
        if($this->getRsa2Sign($arr) == $arr['sign']){
            return true;
        }else{
            return false;
        }
    }

    public function curlRequest($url,$data = ''){
        $ch = curl_init();
        $params[CURLOPT_URL] = $url;    //请求url地址
        $params[CURLOPT_HEADER] = false; //是否返回响应头信息
        $params[CURLOPT_RETURNTRANSFER] = true; //是否将结果返回
        $params[CURLOPT_FOLLOWLOCATION] = true; //是否重定向
        $params[CURLOPT_TIMEOUT] = 30; //超时时间
        if(!empty($data)){
            $params[CURLOPT_POST] = true;
            $params[CURLOPT_POSTFIELDS] = $data;
        }
        $params[CURLOPT_SSL_VERIFYPEER] = false;//请求https时设置,还有其他解决方案
        $params[CURLOPT_SSL_VERIFYHOST] = false;//请求https时,其他方案查看其他博文
        curl_setopt_array($ch, $params); //传入curl参数
        $content = curl_exec($ch); //执行
        curl_close($ch); //关闭连接
        return $content;
    }

}