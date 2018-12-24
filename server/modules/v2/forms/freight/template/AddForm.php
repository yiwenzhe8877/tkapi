<?php

namespace app\modules\v2\forms\freight\template;

use app\componments\sql\SqlCreate;

use app\models\api\store\user\StoreUserApi;
use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
	public $name;
	public $prictype;
	public $express_start;
	public $express_postage;
	public $express_plus;
	public $express_postageplus;
	public $express_addon;
	public $remark;



    public function addRule(){
        return [
            [["name","prictype","express_start","express_postage","express_plus","express_postageplus","express_addon","remark"],'required','message'=>'{attribute}不能为空'],
            ['name', 'unique', 'targetClass' => 'app\models\freight\template', 'message' => '{attribute}已经存在。'],
        ];
    }

    public function run($form){
        $cover=[
            'store_id'=>StoreUserApi::getLoginedStoreId(),

        ];

        $obj=new SqlCreate();
        $obj->setTableName('freight_template');
        $obj->setData($form);
        $obj->setCoverData($cover);
        return $obj->run();

    }
}