<?php

namespace app\modules\v1\forms\member\baseinfo;



use app\componments\sql\SqlCreate;
use app\componments\utils\HttpUtils;
use app\componments\utils\Ip;
use app\componments\utils\RandomUtils;
use app\models\api\common\setting\CommonSettingApi;
use app\models\api\member\group\MemberGroupApi;
use app\models\api\wx\xcx\WxXcxApi;
use app\models\common\setting;
use app\modules\v1\forms\CommonForm;

class XcxDecrptUnionidForm extends CommonForm
{

    public $sessionKey;
    public $iv;
    public $encrptyData;


    public function addRule(){
        return [
            [['iv','sessionKey','encrptyData'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){



        $obj=new WxXcxApi();
        $ret=$obj->getDecriptData($form->sessionKey,$form->iv,$form->encrptyData);
        return $ret;


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