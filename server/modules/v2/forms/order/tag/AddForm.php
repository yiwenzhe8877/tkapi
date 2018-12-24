<?php

namespace app\modules\v2\forms\order\tag;

use app\componments\sql\SqlCreate;

use app\modules\v2\forms\CommonForm;

class AddForm extends CommonForm
{
    public $tag_name;
	public $tag_abbr;
	public $tag_bgcolor;
	public $tag_fgcolor;
	public $rel_count;
	public $displayorder;
	public $enabled;
	


    public function addRule(){
        return [
            [["tag_name","tag_abbr","tag_bgcolor","tag_fgcolor","rel_count","displayorder","enabled"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $obj=new SqlCreate();
        $obj->setTableName('order_tag');
        $obj->setData($form);
        return $obj->run();

    }
}