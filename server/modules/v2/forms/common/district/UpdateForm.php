<?php

namespace app\modules\v2\forms\common\district;



use app\componments\sql\SqlUpdate;
use app\modules\v2\forms\CommonForm;


class UpdateForm extends CommonForm
{


   public $id;
	public $name;
	public $level;
	public $usetype;
	public $upid;
	public $displayorder;
	public $package;
	


    public function addRule(){
       return [
           [["id","name","level","usetype","upid","displayorder","package"],'required','message'=>'{attribute}不能为空'],
           [['id'], 'exist','targetClass' => 'app\models\common\district', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('common_district');
        $obj->setData($form);
        $obj->setWhere(['id='=>$form->id]);
        return $obj->run();

    }
}