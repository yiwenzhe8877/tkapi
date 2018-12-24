<?php

namespace app\modules\v2\forms\freight\template;



use app\componments\sql\SqlGet;
use app\models\api\store\user\StoreUserApi;
use app\modules\v2\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $pageNum;


    public function addRule(){
        return [
            [['pageNum'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){

        $obj=new SqlGet();
        $obj->setTableName('freight_template');
        $obj->setOrderBy('ex_id desc');
        $obj->setWhere(['store_id='=>StoreUserApi::getLoginedStoreId()]);

        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}