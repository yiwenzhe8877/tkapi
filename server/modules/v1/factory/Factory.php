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
        //用户退出

        'memberbase.logout'=>'app\modules\v1\forms\member\base\LogoutForm',

        //用户下级
        'memberbase.team'=>'app\modules\v1\forms\member\base\TeamForm',

        //忘记密码
        'memberbase.forgetpassword'=>'app\modules\v1\forms\member\base\ForgetPasswordForm',

        //用户消息列表
        'membermsg.getlist'=>'app\modules\v1\forms\member\msg\GetListForm',


        //用户支付宝保存
        'membersetting.savezhifubao'=>'app\modules\v1\forms\member\setting\SavezhifubaoForm',


        //用户订单
        'orderbase.getlist'=>'app\modules\v1\forms\order\base\GetlistForm',

        //销售排行
        'goodslist.topsell'=>'app\modules\v1\forms\goods\lists\TopSellForm',

        //提现
        'moneybase.withdraw'=>'app\modules\v1\forms\money\base\WithDrawForm',


        //提现日志
        'moneybase.withdrawlog'=>'app\modules\v1\forms\money\base\WithDrawLogForm'

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