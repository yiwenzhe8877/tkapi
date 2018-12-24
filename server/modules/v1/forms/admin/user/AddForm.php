<?php

namespace app\modules\v1\forms\admin\user;


use app\componments\sql\SqlCreate;
use app\componments\utils\ApiException;
use app\models\AdminGroup;
use app\models\admin\user;
use app\models\api\admin\group\AdminGroupApi;
use app\modules\v1\forms\CommonForm;
use app\modules\v1\service\model\AddService;

class AddForm extends CommonForm
{

    public $username;
    public $password;



        
    public function addRule(){
        return [
            [['username','password'],'required','message'=>'{attribute}不能为空'],
            ['username', 'unique', 'targetClass' => 'app\models\admin\user', 'message' => '{attribute}已经被使用。'],
        ];
    }


    public function run($form){


        $otherdata=[
            'group_id'=>AdminGroupApi::getDefaultGroupId(),
            'group_name'=>AdminGroupApi::getDefaultGroupName(),
            'auth_key'=>getRandom(),
            'password'=>md5($form->password.\Yii::$app->params['salt'])
        ];
        $obj=new SqlCreate();
        $obj->setTableName('admin_user');
        $obj->setData($form);
        $obj->setCoverData($otherdata);
        return $obj->run();

    }


}