<?php

namespace app\modules\v1\forms\member\money;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $money;
	public $change_money;
	public $addtime;
	public $reason;
	public $remark;
	public $operatorid;
	public $operator;
	public $related_id;
	public $realmoudle;
	


    public function addRule(){
        return [
            [["member_id","money","change_money","addtime","reason","remark","operatorid","operator","related_id","realmoudle"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_money');
        $obj->setData($form);
        return $obj->run();

    }
}