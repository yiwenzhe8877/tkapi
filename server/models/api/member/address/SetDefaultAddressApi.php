<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 17:44
 */
namespace app\models\api\member\address;

use app\models\MemberAddress;

class SetDefaultAddressApi
{
    //取消所有的默认
    public static function cancelAllDefaultByMemberId($member_id){

        MemberAddress::updateAll([
            'is_default'=> 0
        ],[
            'obj_type'=>'1',
            'obj_value'=>$member_id
        ]);
    }
    public static function cancelAllDefaultByPrimaryId($addr_id){

        MemberAddress::updateAll([
            'is_default'=> 0
        ],[
            'addr_id'=>$addr_id,
        ]);
    }
}