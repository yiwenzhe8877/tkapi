<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/19
 * Time: 13:33
 */

namespace app\componments\utils;


class HttpUtils
{
    public static function post($url,$data,$header='',$cookie='',$isajax=false,$refer='',$https=false,$returnheader=false,$proxy='')
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, $returnheader);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST,true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        if($header!='')
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }

        if($https==true)
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//当需要访问https网站的时候一定要避开证书的验证
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);//当需要访问https网站的时候一定要避开证书的验证
        }
        if(!empty($proxy))
        {
            curl_setopt ($ch, CURLOPT_PROXY, $proxy);
        }

        $content = curl_exec($ch);
        curl_close($ch);
        return $content;
    }

    public static function get($url,$header='',$cookie='',$refer='',$https=false,$returnhead=false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if($header!='')
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        if($https==true)
        {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_HEADER, $returnhead); //获取header信息
        $text= curl_exec($ch);


        if ($returnhead && curl_getinfo($ch, CURLINFO_HTTP_CODE) == '200') {

            $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header = substr($text, 0, $headerSize);
            $body = substr($text, $headerSize);
            curl_close($ch);

            return array('header'=>$header,'body'=>$body);
        }

        curl_close($ch);
        return $text;
    }


}