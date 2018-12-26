<?php
/**
 * Created by PhpStorm.
 * User: idz025
 * Date: 2018/12/25
 * Time: 13:34
 */

namespace app\modules\v1\forms\member\base;


use app\componments\common\CommonForm;
use app\models\tkuser\Base;

class TeamForm extends CommonForm
{
    public $pageNum;
    public $type;


    public function addRule(){
        return [
            [['pageNum','type'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){

        return Base::getTeamlist($form->type,$form->pageNum);

    }
}