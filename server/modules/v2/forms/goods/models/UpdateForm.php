<?php

namespace app\modules\v1\forms\member\address;



use app\componments\sql\SqlUpdate;
use app\models\api\member\address\SetDefaultAddressApi;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


    public $name;
    public $phone;
    public $province;
    public $city;
    public $district;
    public $community;
    public $address;
    public $is_default;
    public $addr_id;


    public function addRule(){
        return [
            [['name','phone','province','city',"district",'community','address','is_default','addr_id'],'required','message'=>'{attribute}不能为空'],
            ['phone','match','pattern'=>'/^[1][3456789][0-9]{9}$/','message'=>'phone必须是手机号'],
            [['addr_id'], 'exist','targetClass' => 'app\models\MemberAddress', 'message' => '地址id不存在'],
            ['is_default','in','range'=>['1','0'],'message'=>'{attribute}非法'],
        ];
    }

    public function run($form){


        if($form->is_default==1){
            SetDefaultAddressApi::cancelAllDefaultByPrimaryId($form->addr_id);
        }

        $obj=new SqlUpdate();
        $obj->setTableName('member_address');
        $obj->setData($form);
        $obj->setWhere(['addr_id='=>$form->addr_id]);
        return $obj->run();

    }


}