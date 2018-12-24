<?php

namespace app\modules\v3\forms\order\downloadlog;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $download_dateline;
	public $startline;
	public $endline;
	


    public function addRule(){
       return [
           [["id","download_dateline","startline","endline"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\order\downloadlog', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_downloadlog');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}