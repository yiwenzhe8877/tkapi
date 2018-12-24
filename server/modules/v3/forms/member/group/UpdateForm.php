<?php

namespace app\modules\v3\forms\member\group;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $group_id;
	public $group_name;
	public $logo;
	public $dis_count;
	public $experience;
	public $is_default;
	public $is_enabled;
	public $day_limit;
	public $day_limit_price;
	public $remark;
	public $custom;
	public $displayorder;
	public $day_consult;
	public $notupdate;
	


    public function addRule(){
       return [
           [["group_id","group_name","logo","dis_count","experience","is_default","is_enabled","day_limit","day_limit_price","remark","custom","displayorder","day_consult","notupdate"],'required','message'=>'{attribute}不能为空'],
           [['group_id'], 'exist','targetClass' => 'app\models\member\group', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('member_group');
        $obj->setData($form);
        $obj->setWhere(['group_id='=>$form->group_id]);
        return $obj->run();

    }
}