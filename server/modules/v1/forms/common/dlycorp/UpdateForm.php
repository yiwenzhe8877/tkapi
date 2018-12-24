<?php

namespace app\modules\v1\forms\common\dlycorp;



use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $corp_id;
	public $corp_code;
	public $name;
	public $enabled;
	public $ordernum;
	public $website;
	public $request_url;
	public $displayorder;
	public $express;
	


    public function addRule(){
       return [
           [["corp_id","corp_code","name","enabled","ordernum","website","request_url","displayorder","express"],'required','message'=>'{attribute}不能为空'],
           [['corp_id'], 'exist','targetClass' => 'app\models\common\dlycorp', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('common_dlycorp');
        $obj->setData($form);
        $obj->setWhere(['corp_id='=>$form->corp_id]);
        return $obj->run();

    }
}