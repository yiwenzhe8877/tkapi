<?php

namespace app\modules\v3\forms\member\money;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $logid;
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
           [["logid","member_id","money","change_money","addtime","reason","remark","operatorid","operator","related_id","realmoudle"],'required','message'=>'{attribute}不能为空'],
           [['logid'], 'exist','targetClass' => 'app\models\member\money', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_money');
        $obj->setData($form);
        $obj->setWhere(['logid='=>$form->logid]);
        return $obj->run();

    }
}