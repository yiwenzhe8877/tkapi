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
        $user= user::find()
            ->andWhere(['=','admin_id',$id])
            ->one();
        if(!$user)
            ApiException::run("用户不存在",'100003');

        return $user;
    }
}