<?php

namespace app\modules\v1\forms\member\msg;



use app\componments\sql\SqlGet;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $pageNum;
    public $msgtype;

    public function addRule(){
        return [
            [['pageNum','msgtype'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){


        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_msglog');
        $obj->setOrderBy('dateline desc');
        $obj->setWhere(['msgtype='=>$form->msgtype,' and phone='=>$phone]);
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();
    }

}