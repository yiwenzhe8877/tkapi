<?php

namespace app\modules\v1\forms\member\baseinfo;



use app\componments\sql\SqlCreate;
use app\componments\utils\Ip;
use app\componments\utils\RandomUtils;
use app\models\api\member\group\MemberGroupApi;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $pam_account;
    public $password;


    public function addRule(){
        return [
            [['password','pam_account'],'required','message'=>'{attribute}不能为空'],
            ['pam_account', 'unique', 'targetClass' => 'app\models\member\base', 'message' => '此用户名已经被使用。'],
        ];
    }

    public function run($form){
        $cover=[
            'password'=>md5($form->password.\Yii::$app->params['salt']),
            'regdate'=>time(),
            'regip'=>Ip::get_real_ip(),
            'source'=>'api',
            'group_id'=>MemberGroupApi::getDefaultGroup()->group_id,
            'group_name'=>MemberGroupApi::getDefaultGroup()->name,
            'auth_key'=>RandomUtils::get_random_nummixenglish(32)
        ];

        $obj=new SqlCreate();
        $obj->setTableName('member_base');
        $obj->setData($form);
        $obj->setCoverData($cover);
        return $obj->run();

    }


}