<?php


namespace app\modules\v1\factory;


use app\componments\utils\ApiException;

class Factory
{


    static public $SERVICE_MAP =[
        //商品详情
        'goodsdetail.getone'=>'app\modules\v1\forms\goods\detail\GetoneForm',

        //商品分享图片
        'goodsdetail.getsharepic'=>'app\modules\v1\forms\goods\detail\Getsharepicform',

        //用户注册
        'memberbase.register'=>'app\modules\v1\forms\member\base\RegisterForm',

        //发送短信
        'membersms.send'=>'app\modules\v1\forms\member\sms\SendForm',

        //用户登录

        'memberbase.login'=>'app\modules\v1\forms\member\base\LoginForm',
        //用户收入概况

        'memberearning.general'=>'app\modules\v1\forms\member\earning\GeneralForm',

        //用户团队信息
        'membermyteam.getlist'=>'app\modules\v1\forms\member\myteam\GetTeamForm',

        //用户退出
        'memberbase.logout'=>'app\modules\v1\forms\member\base\LogoutForm',
        //用户信息
        'memberbase.userinfo'=>'app\modules\v1\forms\member\base\UserinfoForm',

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

        //首页淘抢购
        'hometqg.getlist'=>'app\modules\v1\forms\home\tqg\GetListForm',

        //首页聚划算
        'homejhs.getall'=>'app\modules\v1\forms\home\jhs\GetAllForm',
        //首页官方推荐
        'homerecommend.getlist'=>'app\modules\v1\forms\home\recommend\GetListForm',

        //创建淘口令
        'homecreatepwd.getpwdbygoodsid'=>'app\modules\v1\forms\home\createpwd\GetPwdByGoodsid',


        //圈子商品
        'goodscircle.getlist'=>'app\modules\v1\forms\goods\circle\GetListForm',

        //提现
        'moneybase.withdraw'=>'app\modules\v1\forms\money\base\WithDrawForm',


        //提现日志
        'moneybase.withdrawlog'=>'app\modules\v1\forms\money\base\WithDrawLogForm',

        //金额日志
        'moneylog.getlist'=>'app\modules\v1\forms\money\log\GetListForm',


        //用户收藏的商品列表
        'goodsfavgoods.getlist'=>'app\modules\v1\forms\goods\favgoods\GetListForm',
        //用户添加商品收藏，
        'goodsfavgoods.add'=>'app\modules\v1\forms\goods\favgoods\AddForm',
        //用户取消商品收藏，
        'goodsfavgoods.delete'=>'app\modules\v1\forms\goods\favgoods\DeleteForm',

        //获得搜索热词
        'searchhot.getall'=>'app\modules\v1\forms\search\hot\GetAllForm',

        //文章列表
        'articlelist.getlist'=>'app\modules\v1\forms\article\article\GetListForm',


        //商品搜索列表
        'goodslist.junlist'=>'app\modules\v1\forms\goods\lists\JunListForm',

        //面单商品列表
        'goodslist.mdlist'=>'app\modules\v1\forms\goods\lists\MianDanForm',


        //文章详情
        'articledetail.getone'=>'app\modules\v1\forms\article\article\GetOneForm',

        //首页轮播
        'homecarousel.get'=>'app\modules\v1\forms\home\carousel\GetListForm',

        //首页最火
        'homemosthot.get'=>'app\modules\v1\forms\home\mosthot\MostHotForm',

        //品牌推荐分类
        'brandrecommend.get'=>'app\modules\v1\forms\brand\recommend\RecommendForm',
        //分类
        'goodscategory.getall'=>'app\modules\v1\forms\goods\category\GetAllForm',

        //转账接口
        'moneytransfer.do'=>'app\modules\v1\forms\money\transfer\TransferForm',

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