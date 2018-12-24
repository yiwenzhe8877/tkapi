<?php

namespace app\modules\v1\common;

use app\componments\auth\QueryParamAuthBackEnd;
use app\componments\filter\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\rest\Controller;
use yii\web\Response;

class BaseController extends Controller
{


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']=[
            'class'=>QueryParamAuthBackEnd::className(),
        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
               // 'application/xml' => Response::FORMAT_XML,
            ],
        ];
        $behaviors['verbFilter']=[
            'class' => VerbFilter::className(),
            'actions' => $this->verbs(),
        ];
        $behaviors['cors']=[
            'class' => Cors::className(),
        ];

        return $behaviors;
    }

}