<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\componments\auth;

use app\componments\utils\ApiException;

use app\componments\utils\ResponseMap;
use app\models\admin\auth;
use app\models\admin\group;
use app\models\admin\groupauth;
use app\models\tkuser\Base;
use yii\filters\auth\AuthMethod;

/**
 * QueryParamAuthBackEnd is an action filter that supports the authentication based on the access token passed through a query parameter.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class QueryParamAuthFrontEnd extends AuthMethod
{
    /**
     * @var string the parameter name for passing the access token
     */


    public $white=['adminuser.login'];

    /**
     * @inheritdoc
     */
    public function authenticate($user, $request, $response)
    {

        //service
        $post=$request->post();

        if(empty($post['service']) || !isset($post['service']))
            ApiException::run(ResponseMap::Map('10010015'),'10010015',__CLASS__,__METHOD__,__LINE__);

        if(in_array($post['service'],$this->white)){
            return true;
        }
        //token
        $accessToken=$request->headers[\Yii::$app->params['token']];

        if(!$accessToken){
            $accessToken = $request->get(\Yii::$app->params['token']);
        }


        if(empty($accessToken))
            ApiException::run(ResponseMap::Map('10010014'),'10010014',__CLASS__,__METHOD__,__LINE__);


        $identity =Base::find()->andWhere(['=','auth_key',$accessToken])->one();

        if ($identity === null)
            ApiException::run(ResponseMap::Map('10010005'),'10010005',__CLASS__,__METHOD__,__LINE__);

        $this->handleApiAuth($identity);


        return true;
    }


    public function handleApiAuth($identity){


        return;
        if($identity->username=='admin'){
            return;
        }

        $group_id=$identity->group_id;

        $group=group::findOne($group_id);

        if(!$group)
            ApiException::run(ResponseMap::Map('10040003'),'10040003',__CLASS__,__METHOD__,__LINE__);


        $re=\Yii::$app->getRequest()->pathInfo;

        $arr=explode('/',$re);

        $module=$arr[0];
        $controller=$arr[1];
        $action=$arr[2];


        $auth=auth::find()
            ->andwhere(['=','module',$module])
            ->andwhere(['=','controller',$controller])
            ->andwhere(['=','action',$action])
            ->one();

        if(!$auth)
            ApiException::run(ResponseMap::Map('10010010'),'10010010',__CLASS__,__METHOD__,__LINE__);

        if($auth->del==1)
            ApiException::run(ResponseMap::Map('10010011'),'10010011',__CLASS__,__METHOD__,__LINE__);

        if($auth->status==0)
            ApiException::run(ResponseMap::Map('10010012'),'10010012',__CLASS__,__METHOD__,__LINE__);


        $auth_id=$auth->auth_id;

        $data=groupauth::find()
            ->where(['=','group_id',$group_id])
            ->andwhere(['=','auth_id',$auth_id])
            ->andwhere(['=','status',1])
            ->all();


        if(!$data)
            ApiException::run(ResponseMap::Map('10040004'),'10040004',__CLASS__,__METHOD__,__LINE__);



    }



}
