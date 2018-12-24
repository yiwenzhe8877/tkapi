<?php

namespace app\modules\v2\forms\order\log;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $log_id;
	public $order_id;
	public $op_id;
	public $op_name;
	public $dateline;
	public $behavior;
	public $result;
	public $log_text;
	public $addon;
	public $ip;
	public $ip_area;
	


    public function addRule(){
       return [
           [["log_id","order_id","op_id","op_name","dateline","behavior","result","log_text","addon","ip","ip_area"],'required','message'=>'{attribute}不能为空'],
           [['log_id'], 'exist','targetClass' => 'app\models\order\log', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_log');
        $obj->setData($form);
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }
}