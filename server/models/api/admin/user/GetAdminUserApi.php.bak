<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 9:26
 */

namespace app\models\api\admin\user;


use app\componments\utils\ApiException;
use app\models\admin\user;

class GetAdminUserApi
{
    public static function getById($id){
        $user= user::findOne($id);
            ApiException::run("用户不存在",'9000001');

        return $user;
    }
}