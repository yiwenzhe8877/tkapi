<?php

namespace app\modules\v3\forms\member\group;

use app\componments\sql\SqlCreate;

use app\componments\common\CommonForm;

class AddForm extends CommonForm
{
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
            [["group_name","logo","dis_count","experience","is_default","is_enabled","day_limit","day_limit_price","remark","custom","displayorder","day_consult","notupdate"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_group');
        $obj->setData($form);
        return $obj->run();

    }
}