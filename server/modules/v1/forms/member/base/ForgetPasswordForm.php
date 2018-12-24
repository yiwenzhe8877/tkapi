<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/24
 * Time: 16:47
 */

namespace app\modules\v1\forms\member\base;


use app\componments\common\CommonForm;
use app\componments\duanxin\Mob;
use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\componments\utils\PwdUtils;
use app\componments\utils\ValidateUtils;

class ForgetPasswordForm extends CommonForm
{
    public $phone;
    public $password;
    public $code;


    public function addRule(){
        return [
            [['phone','password','code'],'required','message'=>'提交的数据不能为空'],
            ['phone', 'exist', 'targetClass' => 'app\models\tkuser\base', 'message' => '此手机号未注册,请先去注册吧~~'],
        ];
    }

    public function run($form){


        $ret=PwdUtils::isStrong($form->password);

        if($ret!==true){
            ApiException::run($ret,'900001');
        }

        if(!ValidateUtils::run_phone($form->phone)){
            ApiException::run("手机号格式错误",'900001');
        }

        //验证code
         Mob::verify_code($form->phone,$form->code);


        $obj=new SqlUpdate();
        $obj->setTableName('tkuser_base');
        $obj->setData(['password'=>PwdUtils::encryptLoginPwd($form->password)]);
        $obj->setWhere(['phone='=>$form->phone]);
        return $obj->run();
    }
}