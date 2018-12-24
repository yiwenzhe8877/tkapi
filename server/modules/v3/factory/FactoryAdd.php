<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/29
 * Time: 16:34
 */

namespace app\modules\v3\factory;


class FactoryAdd
{
    static public $SERVICE_ADD=[
        //商户
        'storeuser.login'=>'app\modules\v3\factory\store\UserFactory',
        'storeuser.logout'=>'app\modules\v3\factory\store\UserFactory',

        //菜单
        'storemenu.getrelationmenu'=>'app\modules\v3\factory\store\MenuFactory',

        //图片
        'images.upload'=>'app\modules\v3\factory\images\ImageFactory',
        //购物车
        'membercart.changecart'=>'app\modules\v3\factory\member\CartFactory',
        //

    ];

    static function getAdd(){
        return self::$SERVICE_ADD;
    }
}