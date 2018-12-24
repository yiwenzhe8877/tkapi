<?php

namespace app\modules\v3\forms\member\verify;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $member_id;
	public $ip;
	public $ip_area;
	public $startline;
	public $endline;
	public $is_verify;
	public $obj_type;
	public $obj_value;
	public $verifcode;
	public $behavior;
	public $username;
	


    public function addRule(){
       return [
           [["id","member_id","ip","ip_area","startline","endline","is_verify","obj_type","obj_value","verifcode","behavior","username"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\verify', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_verify');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}