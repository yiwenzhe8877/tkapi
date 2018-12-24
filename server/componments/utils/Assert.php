<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 9:38
 */

namespace app\componments\utils;


use app\componments\sql\SqlGet;

class Assert
{
    public static function isEmpty($arr){
        foreach ($arr as $k=>$v){
            if(is_string($v)){
                if(empty($v) || $v=='' || $v==null){
                    ApiException::run(ResponseMap::Map('-1'),'-1',__CLASS__,__METHOD__,__LINE__);
                }
            }

            if(is_array($v)){
                if(count($v)==0)
                    ApiException::run(ResponseMap::Map('-1'),'-1',__CLASS__,__METHOD__,__LINE__);
                }
            }
    }

    public static function isNotPageNum($v){

        if(!preg_match('/^[1-9][0-9]*$/',$v,$ma)){
            ApiException::run(ResponseMap::Map('-1'),'-1',__CLASS__,__METHOD__,__LINE__);
        }
    }


    public static function PasswordNotEqual($a,$b){
        if($a!==$b)
            ApiException::run("两次输入的密码不一致",'10040005',__CLASS__,__METHOD__,__LINE__);

    }
    //密码强度
    public static function PwdNotStrong($pwd){
        if(strlen($pwd)<6){
            ApiException::run("密码至少6位",'700003',__CLASS__,__METHOD__,__LINE__);
        }
        if(!preg_match("/[A-Za-z]/",$pwd) || !preg_match("/\d/",$pwd)){
            ApiException::run("密码必须同时包含字母和数字",'700004',__CLASS__,__METHOD__,__LINE__);
        }
    }

    public static function RecordNotExist($table,$where){
        $obj=new SqlGet();
        $obj->setTableName($table);
        $obj->setWhere($where);


        foreach ($where as $k=>$v){
            $m=$k;
            $n=$v;
        }
        if( $obj->get_all()['total']==0){
            ApiException::run("查询".$table."的".$m.$n.'记录不存在','100003',__CLASS__,__METHOD__,__LINE__);
        }
    }
    public static function RecordExist($table,$where){
        $obj=new SqlGet();
        $obj->setTableName($table);
        $obj->setWhere($where);
        foreach ($where as $k=>$v){
            $m=$k;
            $n=$v;
        }
        if( $obj->get_all()['total']>0){
            ApiException::run("查询".$table."的".$m.$n."的记录已经存在,不能添加",'100004',__CLASS__,__METHOD__,__LINE__);
        }
    }

}
