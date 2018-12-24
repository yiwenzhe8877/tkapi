<?php

namespace app\modules\v1\forms\member\address;


use app\componments\sql\SqlCreate;
use app\models\api\member\address\SetDefaultAddressApi;
use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{

    public $name;
    public $phone;
    public $province;
    public $city;
    public $district;
    public $community;
    public $address;
    public $is_default;
    public $member_id;


    public function addRule(){
        return [
            [['name','phone','province','city',"district",'community','address','is_default','member_id'],'required','message'=>'{attribute}不能为空'],
            ['phone','match','pattern'=>'/^[1][3456789][0-9]{9}$/','message'=>'phone必须是手机号'],
            [['member_id'], 'exist','targetClass' => 'app\models\MemberBase', 'message' => '用户不存在'],
            ['is_default','in','range'=>['1','0'],'message'=>'{attribute}非法'],
        ];
    }

    public function run($form){
        if($form->is_default==1){
            SetDefaultAddressApi::cancelAllDefaultByMemberId($form->member_id);
        }
        $cover=[
            'obj_type'=>1,
            'obj_value'=>$form->member_id
        ];
        $unsave=['member_id'];

        $obj=new SqlCreate();
        $obj->setTableName('member_address');
        $obj->setData($form);
        $obj->setCoverData($cover);
        $obj->setUnsavefields($unsave);

        return $obj->run();

    }


}