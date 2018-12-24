<?php


namespace app\modules\v1\factory;


use app\componments\utils\ApiException;

class Factory
{
    static public $SERVICE_MAP =[
        //后台管理
        'adminuser.delete'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.add'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.update'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.getlist'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.getone'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.getadmin'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.changepassword'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.login'=>'app\modules\v1\factory\admin\UserFactory',
        'adminuser.logout'=>'app\modules\v1\factory\admin\UserFactory',
        //后台管理组
        'admingroup.delete'=>'app\modules\v1\factory\admin\GroupFactory',
        'admingroup.add'=>'app\modules\v1\factory\admin\GroupFactory',
        'admingroup.update'=>'app\modules\v1\factory\admin\GroupFactory',
        'admingroup.getlist'=>'app\modules\v1\factory\admin\GroupFactory',
        'admingroup.getall'=>'app\modules\v1\factory\admin\GroupFactory',
        'admingroup.forbid'=>'app\modules\v1\factory\admin\GroupFactory',
        //权限
        'adminauth.delete'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.add'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.update'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.getlist'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.getall'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.setgroupauth'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.syncgroupauth'=>'app\modules\v1\factory\admin\AuthFactory',
        'adminauth.getgroupauthlist'=>'app\modules\v1\factory\admin\AuthFactory',
        //菜单
        'adminmenu.delete'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.add'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.update'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.getlist'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.getall'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.syncgroupmenu'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.setgroupmenu'=>'app\modules\v1\factory\admin\MenuFactory',
        'adminmenu.getmenugrouprelation'=>'app\modules\v1\factory\admin\MenuFactory',

        //后台客户
        'memberbaseinfo.delete'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.add'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.update'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.getlist'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.getall'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.changepassword'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.changeriches'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.xcxadd'=>'app\modules\v1\factory\member\BaseinfoFactory',
        'memberbaseinfo.xcxdecrptunionid'=>'app\modules\v1\factory\member\BaseinfoFactory',

        //后台客户组
        'membergroup.delete'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.add'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.update'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.getlist'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.getall'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.changepassword'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.changeriches'=>'app\modules\v1\factory\member\GroupFactory',
        'membergroup.setdefault'=>'app\modules\v1\factory\member\GroupFactory',

        'memberaddress.add'=>'app\modules\v1\factory\member\AddressFactory',
        'memberaddress.getall'=>'app\modules\v1\factory\member\AddressFactory',
        'memberaddress.getlist'=>'app\modules\v1\factory\member\AddressFactory',
        'memberaddress.update'=>'app\modules\v1\factory\member\AddressFactory',
        //会员消息
        'membermsg.add'=>'app\modules\v1\factory\member\MsgFactory',
        'membermsg.update'=>'app\modules\v1\factory\member\MsgFactory',
        'membermsg.getlist'=>'app\modules\v1\factory\member\MsgFactory',
        'membermsg.getall'=>'app\modules\v1\factory\member\MsgFactory',
        'membermsg.setread'=>'app\modules\v1\factory\member\MsgFactory',
        //商品类别
        'goodscategory.add'=>'app\modules\v1\factory\goods\CategoryFactory',
        'goodscategory.update'=>'app\modules\v1\factory\goods\CategoryFactory',
        'goodscategory.getlist'=>'app\modules\v1\factory\goods\CategoryFactory',
        'goodscategory.getall'=>'app\modules\v1\factory\goods\CategoryFactory',
        //商品模型
        'goodsmodels.add'=>'app\modules\v1\factory\goods\ModelsFactory',
        'goodsmodels.update'=>'app\modules\v1\factory\goods\ModelsFactory',
        'goodsmodels.getlist'=>'app\modules\v1\factory\goods\ModelsFactory',
        'goodsmodels.getall'=>'app\modules\v1\factory\goods\ModelsFactory',


    ];


    //创建相应的支付服务实例
    public static function createInstance($service)
    {
        //判断是否存在这个服务
        if(!array_key_exists($service,self::$SERVICE_MAP))
        {
            ApiException::run("该服务不存在",'900001');
        }

        $clazz = self::$SERVICE_MAP[$service];
        return new $clazz();
    }
}