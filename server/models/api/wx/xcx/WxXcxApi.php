<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/19
 * Time: 14:15
 */
namespace app\models\api\wx\xcx;

use app\componments\utils\ApiException;
use app\componments\utils\HttpUtils;
use app\models\api\common\setting\CommonSettingApi;
use app\models\common\setting;

class WxXcxApi
{
    private $_appid;
    private $_appsecret;


    public function __construct()
    {
        $this->setAppid(CommonSettingApi::getValue('wx','appid'));
        $this->setAppsecret(CommonSettingApi::getValue('wx','appsecret'));
    }

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->_appid;
    }

    /**
     * @param mixed $appid
     */
    public function setAppid($appid)
    {
        $this->_appid = $appid;
    }

    /**
     * @return mixed
     */
    public function getAppsecret()
    {
        return $this->_appsecret;
    }

    /**
     * @param mixed $appsecret
     */
    public function setAppsecret($appsecret)
    {
        $this->_appsecret = $appsecret;
    }


    //https://developers.weixin.qq.com/miniprogram/dev/api/open-api/login/code2Session.html
    public function getOpenIdAndSessionKey($code){
        $url='https://api.weixin.qq.com/sns/jscode2session?appid='.$this->getAppid().'&secret='.$this->getAppsecret().'&js_code='.$code.'&grant_type=authorization_code';
        $ret=HttpUtils::gets($url);

        if(!$ret)
            ApiException::run("请求微信openid接口错误");

        return json_decode($ret);
    }


    //解密encryptedData 数据，获得unionid
    public function getDecriptData($sessionKey,$iv,$encryptedData){
        if (strlen($sessionKey) != 24)
            ApiException::run("sessionKey错误");

        $aesKey=base64_decode($sessionKey);

        if (strlen($iv) != 24)
            ApiException::run("iv错误");

        $aesIV=base64_decode($iv);
        $aesCipher=base64_decode($encryptedData);
        $result=openssl_decrypt( $aesCipher, "AES-128-CBC", $aesKey, 1, $aesIV);
        $dataObj=json_decode( $result );

        if( $dataObj == NULL )
            ApiException::run("解密错误");

        if($dataObj->watermark->appid != $this->getAppid() )
            ApiException::run("解密错误");

        return $result;
    }
}