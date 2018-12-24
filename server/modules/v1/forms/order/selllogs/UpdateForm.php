<?php

namespace app\modules\v1\forms\order\selllogs;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $log_id;
	public $member_id;
	public $order_id;
	public $username;
	public $price;
	public $product_id;
	public $goods_id;
	public $name;
	public $sku;
	public $nums;
	public $dateline;
	


    public function addRule(){
       return [
           [["log_id","member_id","order_id","username","price","product_id","goods_id","name","sku","nums","dateline"],'required','message'=>'{attribute}不能为空'],
           [['log_id'], 'exist','targetClass' => 'app\models\order\selllogs', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_selllogs');
        $obj->setData($form);
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }
}