<?php

namespace app\modules\v1\forms\member\base;





use app\componments\common\CommonForm;
use app\componments\duanxin\Mob;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\componments\utils\Ip;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\componments\utils\ValidateUtils;
use app\models\tkuser\Base;

class LogoutForm extends CommonForm
{



    public function run(){

        $phone=Base::getUserPhone();

        $random=RandomUtils::get_random_nummixenglish(32);

        $obj=new SqlUpdate();
        $obj->setTableName('tkuser_base');
        $obj->setData(['auth_key'=>$random]);
        $obj->setWhere(['phone='=>$phone]);
        return $obj->run();
    }


}