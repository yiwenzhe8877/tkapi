<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/29
 * Time: 16:34
 */

namespace app\modules\v2\factory;


class FactoryAdd
{
    static public $SERVICE_ADD=[
        //商户
        'storeuser.login'=>'app\modules\v2\forms\store\user\LoginForm',
        'storeuser.logout'=>'app\modules\v2\forms\store\user\LogoutForm',

        //菜单
        'storemenu.getrelationmenu'=>'app\modules\v2\forms\store\menu\GetRelationMenuForm',

        //图片
        'images.upload'=>'app\modules\v2\forms\images\upload\UploadForm',
    ];

    static function getAdd(){
        return self::$SERVICE_ADD;
    }
}