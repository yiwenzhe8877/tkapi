<?php

namespace app\modules\v2\forms\member\loginlog;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
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
           [["id","member_id","store_id","ip","ip_area","dateline","username","browser","platform","user_agent"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\member\loginlog', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_loginlog');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}