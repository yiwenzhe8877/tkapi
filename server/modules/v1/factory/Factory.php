<?php


namespace app\modules\v1\factory;


use app\componments\utils\ApiException;

class Factory
{


    static public $SERVICE_MAP =[
        //商品详情
        'goodsdetail.getone'=>'app\modules\v1\forms\goods\detail\GetoneForm',


        //用户注册
        'memberbase.register'=>'app\modules\v1\forms\member\base\RegisterForm',
        //用户登录

        'memberbase.login'=>'app\modules\v1\forms\member\base\LoginForm',

        //忘记密码
        'memberbase.forgetpassword'=>'app\modules\v1\forms\member\base\ForgetPasswordForm',

        'membermsg.getlist'=>'app\modules\v1\forms\member\msg\GetListForm',

    ];


    //创建相应的支付服务实例
    public static function createInstance($service)
    {
        //判断是否存在这个服务
        if(!array_key_exists($service,self::$SERVICE_MAP))
        {
            ApiException::run("该服务不存在",'100010');
        }

        $clazz =self::$SERVICE_MAP[$service];
        return new $clazz();
    }
     public static function getFormName($service)
     {
            //判断是否存在这个服务
            if(!array_key_exists($service,self::$SERVICE_MAP))
            {
                ApiException::run("该服务不存在",'100010');
            }

            return self::$SERVICE_MAP[$service];
     }
}