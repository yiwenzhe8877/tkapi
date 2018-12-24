<?php

namespace app\modules\v3\forms\member\address;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $obj_type;
	public $obj_value;
	public $name;
	public $address;
	public $postalcode;
	public $phone;
	public $remark;
	public $is_deliver;
	public $is_return;
	public $is_selffetch;
	public $province;
	public $city;
	public $district;
	public $community;
	public $sort;
	public $is_show;
	public $is_default;
	


    public function addRule(){
        return [
            [["obj_type","obj_value","name","address","postalcode","phone","remark","is_deliver","is_return","is_selffetch","province","city","district","community","sort","is_show","is_default"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_address');
        $obj->setData($form);
        return $obj->run();

    }
}