<?php

namespace app\modules\v3\forms\freight\template;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
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
            [["store_id","name","prictype","express_start","express_postage","express_plus","express_postageplus","express_addon","remark"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('freight_template');
        $obj->setData($form);
        return $obj->run();

    }
}