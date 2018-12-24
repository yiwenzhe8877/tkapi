<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * DateUtils: 2018/11/15
 * Time: 19:42
 */

namespace app\models\api\sms;


use app\componments\constant\CodeMap;
use app\componments\utils\ApiException;
use app\componments\utils\DateUtils;
use app\componments\utils\Ip;
use app\componments\utils\ValidateUtils;
use app\models\MemberVerify;

class Filter
{


    private $black_ip=[];

    //一台手机一天接收的最大短信数量
    private $day_max_number='5';

    private $white_behavior=[
        'register',
        'forgetpassword',
    ];

    /**
     * @return array
     */
    public function getWhiteBehavior()
    {
        return $this->white_behavior;
    }

    /**
     * @param array $white_behavior
     */
    public function setWhiteBehavior($white_behavior)
    {
        $this->white_behavior = $white_behavior;
    }

    /**
     * @return array
     */
    public function getBlackIp()
    {
        return $this->black_ip;
    }

    /**
     * @param array $black_ip
     */
    public function setBlackIp($black_ip)
    {
        $this->black_ip = $black_ip;
    }

    /**
     * @return string
     */
    public function getDayMaxNumber()
    {
        return $this->day_max_number;
    }

    /**
     * @param string $day_max_number
     */
    public function setDayMaxNumber($day_max_number)
    {
        $this->day_max_number = $day_max_number;
    }

    public  function run($phone,$bebavior,$code){

        if(!ValidateUtils::run_phone($phone)){
            ApiException::run(CodeMap::get_code('300002'),'300002',__CLASS__,__METHOD__,__LINE__);
        }
        if(!ValidateUtils::verify_code($code)){
            ApiException::run("验证码格式错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }

        if(!in_array($bebavior,$this->getWhiteBehavior())){
            ApiException::run("发送短信的行为错误",'900001',__CLASS__,__METHOD__,__LINE__);
        }

        $ip=Ip::get_real_ip();
        if(in_array($ip,$this->getBlackIp())){
            ApiException::run("ip被禁止访问",'900001',__CLASS__,__METHOD__,__LINE__);
        }


        $num=MemberVerify::find()
            ->andWhere(['=','obj_value',$phone])
            ->andWhere(['>','startline',DateUtils::get_day_startline()])
            ->andWhere(['<','endline',DateUtils::get_day_endline()])
            ->count();

        if($num>$this->getDayMaxNumber()){
            ApiException::run("同一个手机一天最多接受".$this->getDayMaxNumber()."条短信",'900001',__CLASS__,__METHOD__,__LINE__);
        }

    }

}