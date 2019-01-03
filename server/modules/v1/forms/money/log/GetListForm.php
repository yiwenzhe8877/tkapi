<?php

namespace app\modules\v1\forms\money\log;



use app\componments\common\CommonForm;
use app\componments\sql\SqlGet;
use app\models\tkuser\Base;

class GetListForm extends CommonForm
{

    public $pageNum;


    public function addRule(){
        return [
            [['pageNum'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){


        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_moneylog');
        $obj->setOrderBy('dateline desc');

        $obj->setFields('FROM_UNIXTIME(dateline,\'%Y-%m-%d %H:%i:%s\') as dateline,change_money,after_money,remark');
        $obj->setWhere(['phone='=>$phone]);
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }


}