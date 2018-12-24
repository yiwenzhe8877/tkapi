<?php

namespace app\modules\v2\forms\member\profile;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $store_id;
	public $realname;
	public $gender;
	public $birthyear;
	public $birthmonth;
	public $birthday;
	public $constellation;
	public $zodiac;
	public $telphone;
	public $mobile;
	public $idcardtype;
	public $idcard;
	public $address;
	public $zipcode;
	public $nationality;
	public $birthprovince;
	public $birthcity;
	public $birthdist;
	public $birthcommunity;
	public $residesuite;
	public $graduateschool;
	public $company;
	public $education;
	public $occupation;
	public $position;
	public $revenue;
	public $affectiverstatus;
	public $bloodtype;
	public $heihgt;
	public $weight;
	public $alipay;
	public $qq;
	public $yahoo;
	public $msn;
	public $taobao;
	public $site;
	public $weixin;
	public $bio;
	public $interest;
	public $timeoffset;
	public $field1;
	public $field2;
	public $field3;
	public $field4;
	public $field5;
	public $field6;
	public $field7;
	public $field8;
	public $field9;
	public $field10;
	public $lastupdate;
	public $haschildren;
	public $province;
	public $city;
	public $dist;
	public $community;
	public $email;
	


    public function addRule(){
        return [
            [["store_id","realname","gender","birthyear","birthmonth","birthday","constellation","zodiac","telphone","mobile","idcardtype","idcard","address","zipcode","nationality","birthprovince","birthcity","birthdist","birthcommunity","residesuite","graduateschool","company","education","occupation","position","revenue","affectiverstatus","bloodtype","heihgt","weight","alipay","qq","yahoo","msn","taobao","site","weixin","bio","interest","timeoffset","field1","field2","field3","field4","field5","field6","field7","field8","field9","field10","lastupdate","haschildren","province","city","dist","community","email"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_profile');
        $obj->setData($form);
        return $obj->run();

    }
}