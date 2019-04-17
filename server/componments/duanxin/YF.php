<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 16:20
 */

namespace app\componments\duanxin;


use app\componments\utils\HttpUtils;

class YF
{

    public static function send($phone,$code){
        $url="https://api.cloudfeng.com/api/v2/sendSms.json";
        $data=array(
            'appKey'=>"lam5UfrB2RXXTk09Zxqso5Zk0MiHvJQm",
            'appSecret'=>"45fc2b6cb2daed27f311fd87de75f3a99562",
            'phones'=>$phone,
            'content'=>"【铃铛优惠券】尊敬的用户,您好.本次的验证码是:".$code."请在收到验证码后5分钟内进行验证"
        );
        $r=HttpUtils::post($url,$data,'','','','',true);

        return $r;
    }
}