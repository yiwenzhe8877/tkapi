<?php


namespace app\modules\v2\forms\admin\user;

use app\componments\utils\ApiException;
use app\componments\utils\Assert;
use app\models\admin\user;
use app\modules\v2\forms\CommonForm;

class ChangePasswordForm extends CommonForm
{

    public $admin_id;
    public $password;
    public $passwordagain;




    public function addRule(){
        return [

            [['admin_id','password','passwordagain'],'required','message'=>'{attribute}不能为空'],
            [['admin_id'], 'exist','targetClass' => 'app\models\admin\user', 'message' => '用户不存在'],
        ];
    }


    public function run($form){

        Assert::PasswordNotEqual($form->password,$form->passwordagain);


        $model=user::findOne($form->admin_id);

        $model->password=md5($form->password.\Yii::$app->params['salt']);

        return $model->save();

    }


}