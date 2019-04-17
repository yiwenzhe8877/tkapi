<?php

namespace app\modules\v1\forms\goods\circle;

use app\componments\common\CommonForm;
use app\componments\platformapi\hdk\Hdk;


class GetListForm extends CommonForm
{
    public $type;
    public $page;


    public function addRule(){
        return [
            [['type','page'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){
        $d= Hdk::excellent_editor($form->page);

        return $d;
    }


}