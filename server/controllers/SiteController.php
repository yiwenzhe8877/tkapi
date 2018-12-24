<?php

namespace app\controllers;

use app\componments\sql\SqlGet;
use app\componments\testapi\ApiTest;
use app\componments\utils\HttpUtils;
use app\componments\utils\RandomUtils;
use app\componments\utils\TableUtils;
use app\models\api\common\setting\CommonSettingApi;
use app\models\apitest\usercase;
use app\models\common\setting;
use app\models\member\msg;
use yii\db\Migration;
use yii\db\TableSchema;
use yii\web\Controller;


class SiteController extends Controller
{


    public function actionIndex()
    {
        return;
        $result = TableUtils::getAllTableNames();
        $module_arr=['v1'];
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);

            $tablename='tk_'.$arr[1].'_'.$arr[2];

            foreach ($module_arr as $k1=>$module){
                $this->makeFactoryCurd($module);
                $this->makeApi($tablename);
                $this->makeModel($tablename);
               // $this->makeFactory($tablename,$module);
                $this->addform($tablename,$module,'add');
                $this->deleteform($tablename,$module,'delete');
                $this->updateform($tablename,$module,'update');
                $this->getlistform($tablename,$module,'getlist');
                $this->getallform($tablename,$module,'getall');
                $this->sqlCreate();
            }
        }


    }

    private function sqlCreate(){
        $result = TableUtils::getAllTableNames();
        $str='';
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);
            $m=$arr[1]."_".$arr[2];
            $n="app\\models\\".$arr[1]."\\".$arr[2];
            $str.='"'.$m.'"'.'=>'."'".$n."'".','."\r\n\t";
        }

        $z=file_get_contents('./template/sqlcreate.txt');
        $z=str_replace('{models}',$str,$z);

        $path='../componments/sql/SqlCreate.php';
        if(file_exists($path)){
            unlink($path);

        }

        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $z);
        fclose($myfile);

    }

    private function makeFactoryCurd($module){
        $result = TableUtils::getAllTableNames();

        $methods_map=['add','update','delete','getlist','getall'];

        $str='';
        foreach ($result as $k =>$v){

            $arr=explode('_',$v);

            //app\modules\v2\factory\store\UserFactory
            foreach ($methods_map as $a=>$b){
                $m=$arr[1].$arr[2];
                $n="app\\modules\\$module\\forms\\".$arr[1]."\\".$arr[2]."\\".$b.'Form';
                $str.='"'.$m.'.'.$b.'"'.'=>'."'".$n."'".','."\r\n\t";
            }
        }


        $z=file_get_contents('./template/factory_curd.txt');

        $z=str_replace('{methods}',$str,$z);
        $z=str_replace('{module}',$module,$z);

        $path='../modules/'.$module.'/factory/Factory.php';
        if(file_exists($path)){
            unlink($path);
        }

        $myfile = fopen($path, "w") or die("Unable to open file!");
        fwrite($myfile, $z);
        fclose($myfile);

    }



    private function makeApi($tablename){
        if($tablename=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/api.txt');
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{classname}',ucfirst($one).ucfirst($two).'Api',$z);

        $dir_one='../models/api/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($one).ucfirst($two).'Api.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }

    }

    private function makeModel($tablename){
        if($tablename=='')return;

        $arr=explode('_',$tablename);
        $z=file_get_contents('./template/model.txt');
        $z=str_replace('{dir}',$arr[1],$z);
        $z=str_replace('{class}',$arr[2],$z);
        $z=str_replace('{tablename}',$tablename,$z);
        $dir='../models/'.$arr[1];
        $filename=$arr[2].'.php';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        if(!file_exists($dir.'/'.$filename)){
            $myfile = fopen($dir.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }


    }

    private function makeFactory($tablename,$module){
        if(empty($tablename)||empty($module))return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/factory.txt');
        $z=str_replace('{dir}',$one,$z);
        $z=str_replace('{class}',ucfirst($two).'Factory',$z);
        $z=str_replace('{tablename}',$one.$two,$z);
        $z=str_replace('{subdir}',$two,$z);
        $z=str_replace('{module}',$module,$z);


        $dir='../modules/'.$module.'/factory/'.$one;
        $filename=ucfirst($two).'Factory.php';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        if(!file_exists($dir.'/'.$filename)){
            $myfile = fopen($dir.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function makeform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);



        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function addform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);
        $str="";
        for ($i=1;$i<count($f);$i++){
            $str.='public $'.$f[$i].";\r\n\t";
        }
        $z=str_replace('{fields}',$str,$z);


        $str="";
        for ($i=1;$i<count($f);$i++){
            $str.='"'.$f[$i].'"'.',';
        }
        $str=substr($str,'0',strlen($str)-1);
        $z=str_replace('{required}',$str,$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function updateform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        //字段
        $str="";
        for ($i=0;$i<count($f);$i++){
            $str.='public $'.$f[$i].";\r\n\t";
        }
        $z=str_replace('{fields}',$str,$z);

        //必填项
        $str="";
        for ($i=0;$i<count($f);$i++){
            $str.='"'.$f[$i].'"'.',';
        }
        $str=substr($str,'0',strlen($str)-1);
        $z=str_replace('{required}',$str,$z);

        //id
        $z=str_replace('{id}',$f[0],$z);
        $tablepath=$one.'\\'.$two;

        $z=str_replace('{tablepath}',$tablepath,$z);

        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function getallform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        //字段

        //必填项



        //id
        $z=str_replace('{id}',$f[0],$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }


    public function getlistform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);



        //id
        $z=str_replace('{id}',$f[0],$z);


        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }

    public function deleteform($tablename,$module,$method){
        if($tablename==''|| $method=='' || $module=='')return;

        $arr=explode('_',$tablename);
        $one=$arr[1];
        $two=$arr[2];
        $z=file_get_contents('./template/'.$method.'form.txt');
        $z=str_replace('{module}',$module,$z);
        $z=str_replace('{one}',$one,$z);
        $z=str_replace('{two}',$two,$z);
        $z=str_replace('{tablename_noprefix}',$one.'_'.$two,$z);
        $f=TableUtils::getTableFields($tablename);

        $z=str_replace('{id}',$f[0],$z);
        $tablepath=$one.'\\'.$two;

        $z=str_replace('{tablepath}',$tablepath,$z);



        $dir_one='../modules/'.$module.'/forms/'.$one;
        $dir_two=$dir_one.'/'.$two;

        $filename=ucfirst($method).'Form.php';
        if(!is_dir($dir_one)){
            mkdir($dir_one);
        }
        if(!is_dir($dir_two)){
            mkdir($dir_two);
        }

        if(!file_exists($dir_two.'/'.$filename)){
            $myfile = fopen($dir_two.'/'.$filename, "w") or die("Unable to open file!");
            fwrite($myfile, $z);
            fclose($myfile);
        }
    }




}
