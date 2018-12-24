<?php

namespace app\modules\v1\forms\admin\menu;


use app\componments\sql\SqlCreate;
use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $name;
    public $router;
    public $pid;
    public $sort;





    public function addRule(){
        return [
            [['name','router','pid','sort'],'required','message'=>'权限名称不能为空'],
            ['name', 'unique', 'targetClass' => 'app\models\admin\menu', 'message' => '{attribute}已经被使用。'],
            ['router', 'unique', 'targetClass' => 'app\models\admin\menu', 'message' => '{attribute}已经被使用。'],

        ];
    }


    public function run($form){



        $obj=new SqlCreate();
        $obj->setTableName('admin_menu');
        $obj->setData($form);
        $obj->run();


        return AdminGroupApi::syncMenus();


    }





}