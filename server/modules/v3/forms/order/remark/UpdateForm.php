<?php

namespace app\modules\v3\forms\order\remark;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $remark_id;
	public $op_id;
	public $op_name;
	public $order_id;
	public $dateline;
	public $ip;
	public $ip_area;
	public $remark;
	


    public function addRule(){
       return [
           [["remark_id","op_id","op_name","order_id","dateline","ip","ip_area","remark"],'required','message'=>'{attribute}不能为空'],
           [['remark_id'], 'exist','targetClass' => 'app\models\order\remark', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_remark');
        $obj->setData($form);
        $obj->setWhere(['remark_id='=>$form->remark_id]);
        return $obj->run();

    }
}