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

class LoginForm extends CommonForm
{

    public $phone;
    public $password;


    public function addRule(){
        return [
            [['phone','password'],'required','message'=>'提交的数据不能为空'],
            ['phone', 'exist', 'targetClass' => 'app\models\tkuser\base', 'message' => '手机号未注册,请先注册哦~~'],
        ];
    }

    public function run($form){

        $user=Base::find()->where(['=','phone',$form->phone])->one();

        if($user->password!= PwdUtils::encryptLoginPwd($form->password)){
            ApiException::run("密码不正确,请重新输入",'900000');
        }

        $random=RandomUtils::get_random_nummixenglish(32);

        $obj=new SqlUpdate();
        $obj->setTableName('tkuser_base');
        $obj->setData(['auth_key'=>$random]);
        $obj->setWhere(['phone='=>$user->phone]);
        $obj->run();
        return ['auth_key'=>$random];
    }


}