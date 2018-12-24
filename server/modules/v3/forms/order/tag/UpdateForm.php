<?php

namespace app\modules\v3\forms\order\tag;



use app\componments\sql\SqlUpdate;
use app\componments\common\CommonForm;


class UpdateForm extends CommonForm
{


   public $tag_id;
	public $tag_name;
	public $tag_abbr;
	public $tag_bgcolor;
	public $tag_fgcolor;
	public $rel_count;
	public $displayorder;
	public $enabled;
	


    public function addRule(){
       return [
           [["tag_id","tag_name","tag_abbr","tag_bgcolor","tag_fgcolor","rel_count","displayorder","enabled"],'required','message'=>'{attribute}不能为空'],
           [['tag_id'], 'exist','targetClass' => 'app\models\order\tag', 'message' => '{attribute}不存在'],

       ];
    }

    public function run($form){

        $obj=new SqlUpdate();
        $obj->setTableName('order_tag');
        $obj->setData($form);
        $obj->setWhere(['tag_id='=>$form->tag_id]);
        return $obj->run();

    }
}