<?php

namespace app\modules\v3\forms\member\loginlog;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
    public $member_id;
	public $store_id;
	public $ip;
	public $ip_area;
	public $dateline;
	public $username;
	public $browser;
	public $platform;
	public $user_agent;
	


    public function addRule(){
        return [
            [["member_id","store_id","ip","ip_area","dateline","username","browser","platform","user_agent"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_loginlog');
        $obj->setData($form);
        return $obj->run();

    }
}