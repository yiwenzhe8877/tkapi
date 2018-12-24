<?php

namespace app\modules\v1\forms\member\baseinfo;


use app\componments\sql\SqlUpdate;
use app\modules\v1\forms\CommonForm;

class ChangeRichesForm extends CommonForm
{

    public $type;
    public $value;
    public $member_id;

    public function addRule(){
        return [
            [['value','type','member_id'],'required','message'=>'{attribute}不能为空'],
            [['value'],'match','pattern'=>'/^[-]?[0-9][1-9]*$/','message'=>'{attribute}必须是整数'],
            ['type','in','range'=>['money','experience','point'],'message'=>'{attribute}非法'],
            [['member_id'], 'exist','targetClass' => 'app\models\member\baseinfo', 'message' => '{attribute}不存在'],
        ];
    }

    public function run($form){
       $obj=new SqlUpdate();
       $obj->setWhere(['member_id='=>$form->member_id]);
       $obj->setTableName('member_baseinfo');
       $obj->setData([$form->type=>$form->value]);
       return  $obj->increase();
    }
}