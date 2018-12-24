<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/17
 * Time: 21:43
 */
namespace app\models\api\goods\classes;

use app\models\GoodsCategory;

class GetGoodsClassListApi
{

    public static function getByPid($pid){
        return GoodsCategory::find()->andWhere(['=','upid',$pid])->all();
    }

}