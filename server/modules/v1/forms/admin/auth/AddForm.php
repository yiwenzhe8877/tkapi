<?php

namespace app\modules\v1\forms\admin\auth;


use app\componments\sql\SqlCreate;
use app\componments\utils\ApiException;
use app\componments\utils\ResponseMap;
use app\models\admin\auth;
use app\modules\v1\forms\CommonForm;


class AddForm extends CommonForm
{
    public $name;
    public $module;
    public $controller;
    public $action;


    public function addRule(){
        return [
            [['name','module','controller','action'],'required','message'=>'{attribute}不能为空'],
            ['name', 'unique', 'targetClass' => 'app\models\admin\auth', 'message' => '{attribute}已经被使用。'],
        ];
    }

    public function run($form){

        $model=auth::find()
            ->andWhere(['=','module',$form->module])
            ->andWhere(['=','controller',$form->controller])
            ->andWhere(['=','action',$form->action])
            ->one();


        if($model){
            ApiException::run(ResponseMap::Map('10050001'),'10050001');
        }

        $obj=new SqlCreate();
        $obj->setTableName('admin_auth');
        $obj->setData($form);
        return $obj->run();


    }





}