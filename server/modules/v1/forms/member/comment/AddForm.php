<?php

namespace app\modules\v1\forms\member\comment;

use app\componments\sql\SqlCreate;

use app\modules\v1\forms\CommonForm;

class AddForm extends CommonForm
{
    public $goods_id;
	public $store_id;
	public $member_id;
	public $member_name;
	public $dis_text;
	public $t_member_id;
	public $t_member_name;
	public $dis_time;
	public $dis_bool;
	


    public function addRule(){
        return [
            [["goods_id","store_id","member_id","member_name","dis_text","t_member_id","t_member_name","dis_time","dis_bool"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('member_comment');
        $obj->setData($form);
        return $obj->run();

    }
}