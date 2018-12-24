<?php


namespace app\componments\duanxin;

use app\componments\utils\ApiException;

class Mob {
    //应用名 铃铛
    //
    public static $appKey="241ac0d1ea352";
    private static $appSecret="8f478e54425a1ab5bc928c70c7c18f4d";

    private static $api="https://webapi.sms.mob.com";

    public static function verify_code($phone,$code){
        return;
        $data=array(
            'appkey' => self::$appKey,
            'phone' => $phone,
            'zone' => '86',
            'code' => $code,
        );
        $r= self::postRequest( self::$api.'/sms/verify',$data);

        $status = json_decode($r)->status;

        if ($status != '200') {
            ApiException::run("验证码错误或失效",'900001');
        }
    }

    /**
     * 发起一个post请求到指定接口
     *
     * @param string $api 请求的接口
     * @param array $params post参数
     * @param int $timeout 超时时间
     * @return string 请求结果
     */
    public static function postRequest( $api, array $params = array(), $timeout = 30 ) {
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $api );
        // 以返回的形式接收信息
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        // 设置为POST方式
        curl_setopt( $ch, CURLOPT_POST, 1 );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $params ) );
        // 不验证https证书
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0 );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Accept: application/json',
        ) );
        // 发送数据
        $response = curl_exec( $ch );
        // 不要忘记释放资源
        curl_close( $ch );
        return $response;
    }

}