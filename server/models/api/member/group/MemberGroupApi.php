<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 21:54
 */
namespace app\models\api\member\group;

use app\models\member\group;

class MemberGroupApi
{
    //获得默认用户组
    public static function getDefaultGroup(){

        return group::findone(['is_default'=>1]);

    }
}