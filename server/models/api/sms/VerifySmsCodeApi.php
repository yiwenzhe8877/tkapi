<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/15
 * Time: 21:18
 */

namespace app\models\api\sms;


use app\componments\utils\ApiException;
use app\componments\utils\ValidateUtils;
use app\models\MemberVerify;
use Codeception\Template\Api;

class VerifySmsCodeApi
{
    private $phone;
    private $code;
    private $_memberVerify;

    /**
     * @return mixed
     */
    public function getMemberVerify()
    {
        return $this->_memberVerify;
    }

    /**
     * @param mixed $memberVerify
     */
    public function setMemberVerify($memberVerify)
    {
        $this->_memberVerify = $memberVerify;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


    public  function before(){
        if(!ValidateUtils::run_phone($this->getPhone())){
            ApiException::run(CodeMap::get_code('300002'),'300002',__CLASS__,__METHOD__,__LINE__);
        }
        if(!ValidateUtils::verify_code($this->getCode())){
            ApiException::run("验证码格式错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }

    }
    //发送验证码
    public  function run(){

        $this->before();

        $model=MemberVerify::find()
            ->andWhere(['=','verifcode',$this->getCode()])
            ->andWhere(['=','obj_value',$this->getPhone()])
            ->andWhere(['<','startline',time()])
            ->andWhere(['>','endline',time()])
            ->andWhere(['=','is_verify',0])
            ->one();
        if(!$model){
            ApiException::run("验证码错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }


        $this->setMemberVerify($model);

        $this->after();
        return  true;
    }


    public function after(){

        $this->getMemberVerify()->is_verify=1;
        $this->getMemberVerify()->save();

    }

}