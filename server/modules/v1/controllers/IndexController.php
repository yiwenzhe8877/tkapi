<?php

namespace app\modules\v1\controllers;

use app\componments\utils\ApiException;
use app\componments\utils\DateUtils;
use app\componments\utils\Service;
use app\modules\v1\common\BaseController;
use app\modules\v1\factory\Factory;

class IndexController  extends BaseController
{



    public function actionIndex()
    {

        
        $service=Service::getServiceName();


        $form = Factory::createInstance($service);
        $formName = Factory::getFormName($service);


        define('FORM_CLASS',$formName);

        if($form->load(\Yii::$app->getRequest()->post(),'') && !$form->validate())
            ApiException::run($form->getError(),'900000',__CLASS__,__METHOD__,__LINE__);

        $data=\Yii::$app->getRequest()->post();

        foreach ($data as $key=>$value)
        {
            if ($key === 'service')
                unset($data[$key]);
        }
        $objdata=(object)$data;

        return $form->run($objdata);

    }

}