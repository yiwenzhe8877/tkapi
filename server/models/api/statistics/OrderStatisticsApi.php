<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/11/22
 * Time: 9:39
 */

namespace app\models\api\statistics;


use app\componments\sql\SqlGet;

class OrderStatisticsApi
{

    public static function getOrderNum($where){

        $sqlwhere=['id>'=>0];

        $obj=new SqlGet();
        $obj->setTableName('order_base');

        foreach ($where as $k=>$v){
            if(!empty($k) && !empty($v)){
                $sqlwhere[' and '.$k]= $v;
            }
        }

        $obj->setWhere($sqlwhere);


        return ['total'=>count($obj->get_all())];

    }
}