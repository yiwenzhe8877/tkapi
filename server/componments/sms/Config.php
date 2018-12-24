<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/15
 * Time: 19:18
 */
namespace app\componments\sms;

class Config
{
    private  $accessKeyId="";
    private  $accessKeyScret="z5nJmxmOGtNl8KUrAJe7k8g5qd8rNx";
    private  $signName='铃铛优惠券';
    private  $verify_template_code='SMS_151085557';

    /**
     * @return string
     */
    public function getVerifyTemplateCode()
    {
        return $this->verify_template_code;
    }

    /**
     * @param string $verify_template_code
     */
    public function setVerifyTemplateCode($verify_template_code)
    {
        $this->verify_template_code = $verify_template_code;
    }

    /**
     * @return string
     */
    public function getSignName()
    {
        return $this->signName;
    }

    /**
     * @param string $signName
     */
    public function setSignName($signName)
    {
        $this->signName = $signName;
    }

    /**
     * @return string
     */
    public  function getAccessKeyId()
    {
        return $this->accessKeyId;
    }

    /**
     * @param string $accessKeyId
     */
    public function setAccessKeyId($accessKeyId)
    {
        $this->accessKeyId = $accessKeyId;
    }

    /**
     * @return string
     */
    public function getAccessKeyScret()
    {
        return $this->accessKeyScret;
    }

    /**
     * @param string $accessKeyScret
     */
    public function setAccessKeyScret($accessKeyScret)
    {
        $this->accessKeyScret = $accessKeyScret;
    }


}