<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/16
 * Time: 11:44
 */
namespace app\models\api\upload;


use app\componments\OSS\Config;

class OssUpload
{
    public static function run($path,$content){

        $config=new Config();

        $url=$config->getEndpoint().$path;

        try {
            $ossClient = new OssClient($config->getAccessKeyId(), $config->getAccessKeySecret(), $config->getEndpoint());
            $ossClient->putObject($config->getBucket(), $path, $content);
            return $url;

        } catch (OssException $e) {
            ApiException::run($e->getMessage(),'900001');
        }

    }
}