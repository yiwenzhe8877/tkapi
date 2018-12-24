<?php

namespace app\modules\v1\forms\order\downloadlog;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $download_dateline;
	public $startline;
	public $endline;
	


    public function addRule(){
        return [
            [["download_dateline","startline","endline"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_downloadlog');
        $obj->setData($form);
        return $obj->run();

    }
}