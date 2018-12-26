<?php

namespace app\modules\v1\forms\money\base;



use app\componments\common\CommonForm;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\models\tkuser\Base;
use app\models\tkuser\WithdrawLog;
use yii\db\Exception;

class WithDrawForm extends CommonForm
{

    public $source;
    public $money;


    public function addRule(){
        return [
            [['source','money'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){




        $source=$form->source;

        if($source=='app'){
            $phone=Base::getUserPhone();
        }
        $data=WithdrawLog::withdrawApi('',$phone,'app',$form->money);

        return $data;
    }


}