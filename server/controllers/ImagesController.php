<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/27
 * Time: 15:33
 */

namespace app\controllers;



use app\componments\utils\DateUtils;
use app\componments\utils\RandomUtils;
use app\models\api\upload\UploadImgApi;
use yii\web\Controller;


class ImagesController extends Controller
{
    public function actionUpload()
    {

        $obj=new UploadImgApi();
        $obj->setDir(DateUtils::getYMD());
        $obj->setFilename(RandomUtils::get_random_num(10));
        $obj->run();

        return ['url'=>$obj->getFullPath(),'filename'=>$obj->getFileNameWithExt()];

    }

}