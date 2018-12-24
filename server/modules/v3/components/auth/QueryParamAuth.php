<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\v2\components\auth;


use app\models\AdminAuth;

use app\models\AdminGroup;
use app\models\AdminGroupAuth;
use app\models\user;
use app\modules\v1\service\user\UserService;
use app\modules\v1\utils\ApiException;
use app\utils\ResponseMap;
use yii\base\UserException;
use yii\filters\auth\AuthMethod;
use yii\log\Logger;

/**
 * QueryParamAuthBackEnd is an action filter that supports the authentication based on the access token passed through a query parameter.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class QueryParamAuth extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */
    public $tokenParam = 'token';

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {

        $accessToken=$request->headers['token'];

        if(!$accessToken){
            $accessToken = $request->get($this->tokenParam);
        }

        $service=\Yii::$app->getRequest()->post('service');

        if($service=='member.login' || $service=='member.register'){
            return true;
        }


        //验证token的
        UserService::getAdminUser();

        if (is_string($accessToken) && !empty($accessToken)) {

            $identity = $user->loginByAccessToken($accessToken, get_class($this));

            if ($identity !== null) {

                $this->handleApiAuth($identity);
                return $identity;
            }
        }


        if (empty($accessToken) ) {

            $this->handlefailure($response);
        }

        return true;
    }

    public function handlefailure($response)
    {
       ApiException::run(ResponseMap::Map('300001'),'300001',__CLASS__,__METHOD__,__LINE__);
    }

    public function handleApiAuth($identity){

        if($identity->username=='admin'){
            return;
        }

        $group_id=$identity->group_id;

        $group=AdminGroup::findOne($group_id);

        if(!$group){
            ApiException::run('管理员的管理组id不存在','900001',__CLASS__,__METHOD__,__LINE__);
        }

        $re=\Yii::$app->getRequest()->pathInfo;

        $arr=explode('/',$re);

        $module=$arr[0];
        $controller=$arr[1];
        $action=$arr[2];


        $auth=AdminAuth::find()
            ->andwhere(['=','module',$module])
            ->andwhere(['=','controller',$controller])
            ->andwhere(['=','action',$action])
            ->one();

        if(!$auth){
            ApiException::run('该接口不存在','900001',__CLASS__,__METHOD__,__LINE__);
        }

        if($auth->del==1){
            ApiException::run('该接口被删除','900001',__CLASS__,__METHOD__,__LINE__);
        }
        if($auth->status==0){
            ApiException::run('该接口被禁用','900001',__CLASS__,__METHOD__,__LINE__);
        }

        $auth_id=$auth->auth_id;


        $data=AdminGroupAuth::find()
            ->where(['=','group_id',$group_id])
            ->andwhere(['=','auth_id',$auth_id])
            ->andwhere(['=','status',1])
            ->all();


        if(!$data){
            ApiException::run('该用户所在组没有权限调用该接口','900001',__CLASS__,__METHOD__,__LINE__);
        }


    }



}
