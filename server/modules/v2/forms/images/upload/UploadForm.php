<?php

namespace app\modules\v2\forms\member\address;


use app\componments\sql\SqlCreate;
use app\componments\utils\DateUtils;
use app\componments\utils\RandomUtils;
use app\models\api\member\address\SetDefaultAddressApi;
use app\models\api\upload\UploadImgApi;
use app\modules\v2\forms\CommonForm;

class UploadForm extends CommonForm
{


    public function run(){
        $obj=new UploadImgApi();
        $obj->setDir(DateUtils::getYMD());
        $obj->setFilename(RandomUtils::get_random_num(10));
        $obj->run();
        return ['url'=>$obj->getFullPath(),'filename'=>$obj->getFileNameWithExt()];
    }


}