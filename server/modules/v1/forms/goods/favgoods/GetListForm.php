<?php

namespace app\modules\v1\forms\goods\favgoods;


use app\componments\common\CommonForm;
use app\componments\sql\SqlDeleteTrue;
use app\componments\sql\SqlGet;
use app\models\tkuser\Base;


class GetListForm extends CommonForm
{

    public $page;


    public function addRule(){
        return [
            [['page'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){

        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_favgoods');
        $obj->setOrderBy('id desc');

        $obj->setWhere(['phone='=>$phone]);
        $obj->setPageNum($form->page);
        return $obj->get_list();
    }


}