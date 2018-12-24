<?php

namespace app\modules\v2\forms\admin\user;


use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\models\admin\user;
use app\modules\v2\forms\CommonForm;

class LoginForm extends CommonForm
{
    public $username;
    public $password;

    private $_user;




    public function addRule(){
        return [
            ['username','required','message'=>'用户名不能为空'],
            ['password','required','message'=>'密码不能为空'],
            ['username', 'exist','targetClass' => '\app\models\admin\user', 'message' => '用户不存在'],
            [['password'],'checkpwd','skipOnEmpty' => false, 'skipOnError' => false,'params'=>['wrong_pwd'=>"密码错误"]],
            [['username'],'checkstatus','skipOnEmpty' => false, 'skipOnError' => false,'params'=>['wrong_status'=>"用户被禁用",'del'=>'用户被删除']],
        ];
    }

    // 检测密码
    public function checkpwd($attribute, $params)
    {

        $user=user::findOne(['username'=>$this->username,'password'=>md5($this->password.\Yii::$app->params['salt'])]);

        if(!$user)
            ApiException::run($params['wrong_pwd'],'100011',__CLASS__,__METHOD__,__LINE__);


        $this->_user=$user;
        return true;
    }

    // 检测
    public function checkstatus()
    {

        $user=user::findOne(['username'=>$this->username,'status'=>0]);

        if($user)
            ApiException::run("管理员被禁用",'10040006',__CLASS__,__METHOD__,__LINE__);


        $user=user::findOne(['username'=>$this->username,'del'=>1]);

        if($user)
            ApiException::run("管理员被删除",'10040007',__CLASS__,__METHOD__,__LINE__);



        return true;
    }


    //登录
    public function run($form){





        $auth_key=1;

        $obj=new SqlUpdate();
        $obj->setTableName('store_user');
        $obj->setData(['auth_key'=>$auth_key]);
        $obj->setWhere(['username='=>$form->username]);
        $obj->run();

        /*user::updateAll([
            'auth_key'=>$auth_key
        ],[
            'username'=>$form->username
        ]);*/

        return ['accessToken'=>$auth_key];
    }

}