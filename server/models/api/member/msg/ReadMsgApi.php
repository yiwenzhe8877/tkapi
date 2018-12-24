<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 21:54
 */
namespace app\models\api\member\msg;

use app\componments\sql\SqlGet;
use app\models\MemberGroup;
use app\models\MemberMsg;

class ReadMsgApi
{
    //设置已读
    public static function setIsRead($msg_id){
           return MemberMsg::updateAll([
                'is_read'=>1
            ],[
                'msg_id'=>$msg_id
            ]);
    }
}