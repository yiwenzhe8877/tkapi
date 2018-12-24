<?php

namespace app\modules\v3\forms\member\address;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $addr_id;
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
           [["addr_id","obj_type","obj_value","name","address","postalcode","phone","remark","is_deliver","is_return","is_selffetch","province","city","district","community","sort","is_show","is_default"],'required','message'=>'{attribute}不能为空'],
           [['addr_id'], 'exist','targetClass' => 'app\models\member\address', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_address');
        $obj->setData($form);
        $obj->setWhere(['addr_id='=>$form->addr_id]);
        return $obj->run();

    }
}