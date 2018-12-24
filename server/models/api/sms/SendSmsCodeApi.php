<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/15
 * Time: 19:39
 */
namespace app\models\api\sms;

use app\componments\sms\SendSms;
use app\componments\utils\Ip;
use app\models\MemberVerify;

class SendSmsCodeApi
{
    private $phone;
    private $behavior;
    private $code;

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
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * @param mixed $behavior
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;
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
        $obj=new Filter();
        $obj->run($this->getPhone(),$this->getBehavior(),$this->getCode());
    }
    //发送验证码
    public  function run(){

        $this->before();
        SendSms::send_code($this->getPhone(),$this->getCode());
        $this->after();
    }


    public function after(){
        $obj=new MemberVerify();
        $obj->obj_type=1;
        $obj->obj_value=$this->getPhone();
        $obj->verifcode=$this->getCode();
        $obj->behavior=$this->getBehavior();
        $obj->ip=Ip::get_real_ip();
        $obj->startline=time();
        $obj->endline=time()+300;
        $obj->save();

    }

}