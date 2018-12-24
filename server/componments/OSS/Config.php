<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/16
 * Time: 11:41
 */

namespace app\componments\OSS;


class Config
{
    private $_accessKeyId = "";
    private $_accessKeySecret = "7pBpF0tvGOlrzEm2tdeR8pQZ4OYzMC";
    private $_endpoint = "http://oss-cn-zhangjiakou.aliyuncs.com";
    private $_bucket= "wwdqz";

    /**
     * @return string
     */
    public function getAccessKeyId()
    {
        return $this->_accessKeyId;
    }

    /**
     * @param string $accessKeyId
     */
    public function setAccessKeyId($accessKeyId)
    {
        $this->_accessKeyId = $accessKeyId;
    }

    /**
     * @return string
     */
    public function getAccessKeySecret()
    {
        return $this->_accessKeySecret;
    }

    /**
     * @param string $accessKeySecret
     */
    public function setAccessKeySecret($accessKeySecret)
    {
        $this->_accessKeySecret = $accessKeySecret;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->_endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint($endpoint)
    {
        $this->_endpoint = $endpoint;
    }

    /**
     * @return string
     */
    public function getBucket()
    {
        return $this->_bucket;
    }

    /**
     * @param string $bucket
     */
    public function setBucket($bucket)
    {
        $this->_bucket = $bucket;
    }


}