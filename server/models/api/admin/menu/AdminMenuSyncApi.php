<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 10:09
 */
namespace app\models\api\admin\menu;

use app\models\admin\menu;

class AdminMenuSyncApi
{
    public static function sync(){
        $menu=menu::find()->all();
        $group=AdminGroup::find()->all();

        for($i=0;$i<count($group);$i++){

            $group_id=$group[$i]->group_id;
            for($j=0;$j<count($menu);$j++){
                $menu_id=$menu[$j]->menu_id;

                $data=AdminMenuGroup::find()
                    ->andWhere(['=','group_id',$group_id])
                    ->andWhere(['=','menu_id',$menu_id])
                    ->one();
                if(!$data){
                    $model=new AdminMenuGroup();
                    $model->menu_id=$menu_id;
                    $model->group_id=$group_id;
                    $model->status=1;
                    $model->save();
                }

            }
        }
    }

}