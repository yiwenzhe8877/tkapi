<?php

namespace app\modules\v2\forms\freight\template;

use app\componments\sql\SqlDeleteTrue;
use app\componments\sql\SqlUpdate;
use app\models\api\store\user\StoreUserApi;
use app\modules\v2\forms\CommonForm;

class DeleteForm extends CommonForm
{
    public $ex_id;

    public function addRule(){
        return [
            [['ex_id'],'required','message'=>'{attribute}不能为空'],
            [['ex_id'], 'exist','targetClass' => 'app\models\freight\template', 'message' => '{attribute}不存在'],
        ];
    }


    public function run($form){
        $obj=new SqlDeleteTrue();

        $obj->setTableName('freight_template');
        $obj->setWhere(['ex_id='=>$form->ex_id,' and store_id='=>StoreUserApi::getLoginedStoreId()]);
        return $obj->run();

    }

}