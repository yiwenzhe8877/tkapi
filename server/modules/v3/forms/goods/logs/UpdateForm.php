<?php

namespace app\modules\v3\forms\goods\logs;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $log_id;
	public $goods_id;
	public $store_id;
	public $types;
	public $dateline;
	public $admin_id;
	public $admin_name;
	public $ip;
	public $ip_area;
	public $addon;
	public $remark;
	public $del;
	


    public function addRule(){
       return [
           [["log_id","goods_id","store_id","types","dateline","admin_id","admin_name","ip","ip_area","addon","remark","del"],'required','message'=>'{attribute}不能为空'],
           [['log_id'], 'exist','targetClass' => 'app\models\goods\logs', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('goods_logs');
        $obj->setData($form);
        $obj->setWhere(['log_id='=>$form->log_id]);
        return $obj->run();

    }
}