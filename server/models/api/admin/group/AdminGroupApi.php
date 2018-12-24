<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/18
 * Time: 11:45
 */

namespace app\models\api\admin\group;


use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\models\admin\auth;
use app\models\admin\group;
use app\models\admin\groupauth;
use app\models\admin\menu;
use app\models\admin\menugroup;


class AdminGroupApi
{

    public static function getDefaultGroupId(){
                return self::getDefaultGroup()->group_id;
    }
    public static function getDefaultGroupName(){
        return self::getDefaultGroup()->group_name;
    }

    public static function getAuthsListByGroupId($pageNum='',$group_id=''){

        $pagesize=\Yii::$app->params['page_size'];

        Assert::RecordNotExist('admin_group',['group_id='=>$group_id]);
        Assert::isNotPageNum($pageNum);


        $model= auth::find()
            ->select("tk_admin_auth.*,tk_admin_group_auth.*")
            ->leftJoin('tk_admin_group_auth','tk_admin_auth.auth_id=tk_admin_group_auth.auth_id')
            ->andWhere(['=','tk_admin_group_auth.group_id',$group_id])
            ->offset(($pageNum-1)*$pagesize)
            ->limit($pagesize);


        $data=$model->asArray(true)->all();
        $count=$model->count();

        return [
            'pageNum'=>$pageNum,
            'pageSize'=>$pagesize,
            'total'=>(int)$count,
            'list'=>$data
        ];
    }

    //设置组权限
    public static function setGroupAuths($group_id,$auth_ids){

        $arr=explode(',',$auth_ids);

        foreach ($arr as $v){
            $model=auth::find()
                ->andWhere(['=','auth_id',$v])
                ->one();

            if(!$model){
                ApiException::run("权限id:".$v."不存在",'100003');
            }

            $model=groupauth::find()
                ->andWhere(['=','auth_id',$v])
                ->andWhere(['=','group_id',$group_id])
                ->one();

            if(!$model){
                ApiException::run("权限id和组group_id:".$v."不存在",'100003');
            }
        }

        $data=groupauth::find()
            ->andWhere(['=','group_id',$group_id])
            ->all();

        for($i=0,$l=count($data);$i<$l;$i++){
            $auth_id=$data[$i]->auth_id;
            if(in_array($auth_id,$arr)){
                $s=1;
            }else{
                $s=0;
            }

            $model=groupauth::find()
                ->andWhere(['=','auth_id',$auth_id])
                ->andWhere(['=','group_id',$group_id])
                ->one();
            $model->is_enable=$s;
            $model->save();
        }

        return "";
    }

    public static function setGroupMenu($group_id,$menu_ids){
        set_time_limit(0);
        $arr=explode(',',$menu_ids);

        foreach ($arr as $v){
            $model=menu::find()
                ->andWhere(['=','menu_id',$v])
                ->one();

            if(!$model){
                ApiException::run("菜单id:".$v."不存在",'900001');
            }



            $model=menugroup::find()
                ->andWhere(['=','menu_id',$v])
                ->andWhere(['=','group_id',$group_id])
                ->one();

            if(!$model){
                ApiException::run("菜单id:".$v."不存在",'900001');
            }
        }

        $data=menugroup::find()
            ->andWhere(['=','group_id',$group_id])
            ->all();

        for($i=0,$l=count($data);$i<$l;$i++){
            $menu_id=$data[$i]->menu_id;
            if(in_array($menu_id,$arr)){
                $s=1;
            }else{
                $s=0;
            }

            $model=menugroup::find()
                ->andWhere(['=','menu_id',$menu_id])
                ->andWhere(['=','group_id',$group_id])
                ->one();
            $model->is_enable=$s;
            $model->save();
        }
        return "";
    }

    public static function syncMenu(){
        $menu=menu::find()->all();
        $group=group::find()->all();

        for($i=0;$i<count($group);$i++){

            $group_id=$group[$i]->group_id;
            for($j=0;$j<count($menu);$j++){
                $menu_id=$menu[$j]->menu_id;

                $data=menugroup::find()
                    ->andWhere(['=','group_id',$group_id])
                    ->andWhere(['=','menu_id',$menu_id])
                    ->one();
                if(!$data){
                    $model=new menugroup();
                    $model->menu_id=$menu_id;
                    $model->group_id=$group_id;
                    $model->is_enable=1;
                    $model->save();
                }
            }
        }
        return "";
    }

    //
    public static function syncAuths(){
        set_time_limit(0);

        $auth=auth::find()->all();
        $group=group::find()->all();

        for($i=0;$i<count($group);$i++){

            $group_id=$group[$i]->group_id;
            for($j=0;$j<count($auth);$j++){
                $auth_id=$auth[$j]->auth_id;

                $data=groupauth::find()
                    ->andWhere(['=','group_id',$group_id])
                    ->andWhere(['=','auth_id',$auth_id])
                    ->one();
                if(!$data){
                    $model=new groupauth();
                    $model->auth_id=$auth_id;
                    $model->group_id=$group_id;
                    $model->is_enable=1;
                    $model->save();
                }
            }

        }
        return "";
    }



    public static function getGroupMenus($group_id){


        $menuarr=group::findOne($group_id)->groupMenus;


        $menuids='';
        for($i=0;$i<count($menuarr);$i++){
            $menuids.=$menuarr[$i]->menu_id.',';
        }

        $menu_ids=substr($menuids,0,strlen($menuids)-1);

        $sql='select * FROM tk_admin_menu order by sort desc';
        if(!empty($menu_ids)){
            $sql=   'select * FROM tk_admin_menu where menu_id in ('.$menu_ids.') order by sort desc';
        }
        $data = \Yii::$app->db->createCommand($sql)->queryAll();

        $pidarr=[];
        $temp=[];
        for($i=0;$i<count($data);$i++){
            $pid=$data[$i]['pid'];
            $menu_id=$data[$i]['menu_id'];
            if($pid==0){
                $data[$i]['child']=[];
                array_push($temp,$data[$i]);
                array_push($pidarr,$menu_id);
            }
        }
        for($i=0;$i<count($data);$i++){
            $pid=$data[$i]['pid'];
            if($pid==0){continue;}

            for($j=0;$j<count($temp);$j++){
                if($pid==$temp[$j]['menu_id']){
                    array_push($temp[$j]['child'],$data[$i]);
                }
            }

        }

        return [
            'list'=>$temp
        ];
    }

    private static function getDefaultGroup(){
        return group::find()->where(['is_default'=>1])->one();
    }


}