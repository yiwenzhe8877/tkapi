<?php


namespace app\models\api\goods\category;


use app\componments\sql\SqlGet;
use app\componments\utils\Assert;
use app\models\api\store\user\StoreUserApi;


class GoodsCategoryApi
{
    public static function getRelation(){
        $obj=new SqlGet();
        $obj->setTableName('goods_category');
        $obj->setOrderBy('sort desc');
        $obj->setWhere(['store_id='=>StoreUserApi::getLoginedStoreId(),' and level='=>0]);
        $data= $obj->get_all();
        $list1=$data['list'];
        for ($i=0;$i<count($list1);$i++){
            $list1[$i]['one']=[];
        }


        $obj=new SqlGet();
        $obj->setTableName('goods_category');
        $obj->setOrderBy('sort desc');
        $obj->setWhere(['store_id='=>StoreUserApi::getLoginedStoreId(),' and level='=>1]);
        $data= $obj->get_all();
        $list2=$data['list'];
        for ($i=0;$i<count($list2);$i++){
            $list2[$i]['two']=[];
        }

        $obj=new SqlGet();
        $obj->setTableName('goods_category');
        $obj->setOrderBy('sort desc');
        $obj->setWhere(['store_id='=>StoreUserApi::getLoginedStoreId(),' and level='=>2]);
        $data= $obj->get_all();
        $list3=$data['list'];

        //先把list3套到list2,再把list2套进list1
        for ($i=0;$i<count($list2);$i++){
            for ($m=0;$m<count($list3);$m++){
                if($list3[$m]['pid']==$list2[$i]['classid'] && !in_array($list3[$m],$list2[$i]['two'])){
                    array_push($list2[$i]['two'],$list3[$m]);
                }
            }
        }
        for ($i=0;$i<count($list1);$i++){
            for ($m=0;$m<count($list2);$m++){
                if($list2[$m]['pid']==$list1[$i]['classid'] && !in_array($list2[$m],$list1[$i]['one'])){
                    array_push($list1[$i]['one'],$list2[$m]);
                }
            }
        }

        return $list1;
    }
}