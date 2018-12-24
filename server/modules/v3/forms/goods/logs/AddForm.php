<?php

namespace app\modules\v3\forms\goods\logs;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["goods_id","store_id","types","dateline","admin_id","admin_name","ip","ip_area","addon","remark","del"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('goods_logs');
        $obj->setData($form);
        return $obj->run();

    }
}