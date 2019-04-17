<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/1
 * Time: 16:00
 */
namespace app\modules\v1\forms\member\sms;

use app\componments\common\CommonForm;
use app\componments\duanxin\YF;
use app\componments\sql\SqlCreate;
use app\componments\utils\ApiException;
use app\componments\utils\RandomUtils;
use app\componments\utils\ValidateUtils;
use app\models\tkuser\Base;
use app\models\tkuser\Verifycode;

class SendForm extends CommonForm
{
    public $phone;

    public function addRule(){
        return [
            [['phone'],'required','message'=>'提交的数据不能为空'],
        ];
    }
    public function run($form){


        $phone=$form->phone;
        $type=$form->type;


        if(!ValidateUtils::run_phone($phone))
            ApiException::run("手机号格式错误",'900000');

        $code=RandomUtils::get_random_num(4);


        //注册的话检测是否已经注册过了
//        if($form->service=''  &&  Base::is_exist('phone',$phone)){
//            ApiException::run("该用户已经注册过了",'900000');
//        }

        //检测最大发送量
        Verifycode::can_send($phone);


        $cover=[
            'phone'=>$phone,
            'code'=>$code,
            'channel'=>'yf',
            'dateline'=>time(),
            'expire'=>time()+300,
            'is_used'=>0,
            'type'=>$type,
        ];
        $obj=new SqlCreate();
        $obj->setTableName('tkuser_verifycode');
        $obj->setCoverData($cover);
        $obj->run();

        $ret= YF::send($form->phone,$code);

        return $ret;
    }


}