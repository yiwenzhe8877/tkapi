<?php

namespace app\modules\v3\forms\order\pmt;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $pmt_id;
	public $order_id;
	public $product_id;
	public $pmt_type;
	public $pmt_amount;
	public $pmt_tag;
	public $pmt_memo;
	public $pmt_describe;
	public $goods_id;
	


    public function addRule(){
       return [
           [["pmt_id","order_id","product_id","pmt_type","pmt_amount","pmt_tag","pmt_memo","pmt_describe","goods_id"],'required','message'=>'{attribute}不能为空'],
           [['pmt_id'], 'exist','targetClass' => 'app\models\order\pmt', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_pmt');
        $obj->setData($form);
        $obj->setWhere(['pmt_id='=>$form->pmt_id]);
        return $obj->run();

    }
}