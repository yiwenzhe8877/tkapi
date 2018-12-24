<?php

namespace app\modules\v3\forms\member\verify;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["member_id","ip","ip_area","startline","endline","is_verify","obj_type","obj_value","verifcode","behavior","username"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_verify');
        $obj->setData($form);
        return $obj->run();

    }
}