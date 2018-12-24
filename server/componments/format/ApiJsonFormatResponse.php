<?php

namespace app\componments\format;

use yii\helpers\Json;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

class ApiJsonFormatResponse extends JsonResponseFormatter
{
    //格式化响应
    protected function formatJson($response)
    {

        $service=\Yii::$app->getRequest()->post('service');
        $url=\Yii::$app->getRequest()->getUrl();
        $response->getHeaders()->set('Content-Type', 'application/json; charset=UTF-8');
        if ($response->data !== null) {
            $options = $this->encodeOptions;
            if ($this->prettyPrint) {
                $options |= JSON_PRETTY_PRINT;
            }

            if($response->getIsSuccessful())
            {
                $response->data=[
                    'status'=>"success",
                    'code'=>'0',
                    'msg'=>'成功',
                    'data'=>$response->data
                ];
            }
            else
            {
                $response->setStatusCode(200);

                $response->data = [
                    'status'=>'fail',
                    'code'=>"{$response->data['code']}",
                    'msg'=> json_decode(($response->data['message']))->msg,
                    'service'=>$service,
                    'url'=>$url,
                    'location'=>json_decode(($response->data['message']))->location ,

                ];
            }
            $response->content = Json::encode($response->data, $options);
        }
    }
}