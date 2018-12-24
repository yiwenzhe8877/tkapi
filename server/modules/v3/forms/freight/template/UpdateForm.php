<?php

namespace app\modules\v3\forms\freight\template;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $ex_id;
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
           [["ex_id","store_id","name","prictype","express_start","express_postage","express_plus","express_postageplus","express_addon","remark"],'required','message'=>'{attribute}不能为空'],
           [['ex_id'], 'exist','targetClass' => 'app\models\freight\template', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('freight_template');
        $obj->setData($form);
        $obj->setWhere(['ex_id='=>$form->ex_id]);
        return $obj->run();

    }
}