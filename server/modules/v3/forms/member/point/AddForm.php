<?php

namespace app\modules\v3\forms\member\point;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $store_id;
	public $point;
	public $change_point;
	public $addtime;
	public $reason;
	public $remark;
	public $operatorid;
	public $operator;
	public $related_id;
	public $realmoudle;
	


    public function addRule(){
        return [
            [["member_id","store_id","point","change_point","addtime","reason","remark","operatorid","operator","related_id","realmoudle"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_point');
        $obj->setData($form);
        return $obj->run();

    }
}