<?php

namespace app\modules\v3\forms\common\dlycorp;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["corp_code","name","enabled","ordernum","website","request_url","displayorder","express"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('common_dlycorp');
        $obj->setData($form);
        return $obj->run();

    }
}