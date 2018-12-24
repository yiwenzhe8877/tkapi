<?php

namespace app\modules\v1\forms\admin\auth;


use app\componments\sql\SqlUpdate;
use app\models\admin\auth;
use app\models\AdminAuth;
use app\models\AdminGroup;
use app\models\user;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\model\UpdateService;

use app\componments\utils\ApiException;

class UpdateForm extends CommonForm
{
    public $auth_id;
    public $name;




    public function addRule(){
        return [
            [['auth_id','name'],'required','message'=>'{attribute}不能为空'],
            [['auth_id'], 'exist','targetClass' => 'app\models\admin\auth', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){


        $obj=new SqlUpdate();
        $obj->setTableName('admin_auth');
        $obj->setData($form);
        $obj->setWhere(['auth_id='=>$form->auth_id]);
        return $obj->run();


    }


}