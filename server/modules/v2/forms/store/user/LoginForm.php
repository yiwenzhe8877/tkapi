<?php

namespace app\modules\v2\forms\store\user;


use app\componments\utils\ApiException;
use app\models\store\user;
use app\modules\v2\forms\CommonForm;

class LoginForm extends CommonForm
{
    public $username;
    public $password;

    private $_user;


    public function addRule(){
        return [
            [['username','password'],'required','message'=>'{attribute}不能为空'],
            ['username', 'exist','targetClass' => '\app\models\store\user', 'message' => '{attribute}不存在'],
            [['password'],'checkpwd','skipOnEmpty' => false, 'skipOnError' => false,'params'=>['wrong_pwd'=>"密码错误"]],
            [['username'],'checkstatus','skipOnEmpty' => false, 'skipOnError' => false,'params'=>['wrong_status'=>"用户被禁用",'del'=>'用户被删除']],
        ];
    }

    // 检测密码
    public function checkpwd($attribute, $params)
    {

        $user=user::findOne(['username'=>$this->username,'password'=>md5($this->password.\Yii::$app->params['salt'])]);

        if(!$user){
            ApiException::run($params['wrong_pwd'],"100011");
        }
        $this->_user=$user;
        return true;
    }

    // 检测
    public function checkstatus()
    {

        $user=user::findOne(['username'=>$this->username,'status'=>0]);

        if($user)
            ApiException::run("管理员被禁用","10040006");

        $user=user::findOne(['username'=>$this->username,'del'=>1]);

        if($user)
            ApiException::run("管理员被删除","10040007");


        return true;
    }


    //登录
    public function run($form){



        /*if(YII_DEBUG){
            $auth_key="bdegkortvwxyABDIKMQRSTUWYZ023456";
        }else{

        }*/
        $auth_key=1;

        user::updateAll([
            'auth_key'=>$auth_key
        ],[
            'username'=>$form->username
        ]);

        return ['accessToken'=>$auth_key];
    }

}