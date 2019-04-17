<?php

namespace app\modules\v1\forms\member\base;





use app\componments\common\CommonForm;
use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\models\tkuser\Base;

class UserinfoForm extends CommonForm
{

    public function run(){
        $d= Base::getUserinfo();

        return [
            "phone"=>$d->phone,
            'yaoqingma'=>$d->yaoqingma,
            'group_name'=>$d->group_name,
            'remainmoney'=>$d->remainmoney,
            'weixin'=>$d->weixin,
            'zhifubao_name'=>$d->zhifubao_name,
            'zhifubao'=>$d->zhifubao
        ];

    }

}