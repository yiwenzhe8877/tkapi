<?php

namespace app\modules\v1\forms\member\base;





use app\componments\common\CommonForm;
use app\componments\duanxin\Mob;
use app\componments\sql\SqlCreate;
use app\componments\utils\ApiException;
use app\componments\utils\Ip;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\componments\utils\ValidateUtils;
use app\models\tkuser\Base;
use app\models\tkuser\Verifycode;

class RegisterForm extends CommonForm
{

    public $phone;
    public $password;
    public $code;
    public $yaoqingma;


    public function addRule(){
        return [
            [['phone','password','code','yaoqingma'],'required','message'=>'提交的数据不能为空'],
            ['phone', 'unique', 'targetClass' => 'app\models\tkuser\base', 'message' => '此手机号已经被使用,请点击忘记密码试试~'],
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

        $one=Base::find()->where(['=','yaoqingma',$form->yaoqingma])->one();
        if(!$one){
            ApiException::run("邀请码不存在",'900001');
        }
        $p_phone=$one->phone;


        if($p_phone==null || $p_phone==''){
            ApiException::run("父级手机不存在",'900001');
        }

        $s_phone= Base::getSuperPhone($p_phone);


        //验证code
       // Mob::verify_code($form->phone,$form->code);

        if(!YII_DEBUG){
            Verifycode::verify_code_yf($form->phone,$form->code,2);
        }


        $cover=[
            'password'=>PwdUtils::encryptLoginPwd($form->password),
            'phone'=>$form->phone,
            'p_phone'=>$p_phone,
            's_phone'=>$s_phone,
            'group_id'=>1,
            'group_name'=>\Yii::$app->params['user_group']['1'],
            'auth_key'=>RandomUtils::get_random_nummixenglish(32),
            'yaoqingma'=>RandomUtils::get_random_nummixenglish(6),
            'jointime'=>time()
        ];

        $obj=new SqlCreate();
        $obj->setTableName('tkuser_base');
        $obj->setCoverData($cover);
        return $obj->run();

    }


}