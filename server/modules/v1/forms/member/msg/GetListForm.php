<?php

namespace app\modules\v1\forms\member\msg;



use app\componments\sql\SqlGet;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $page;
    public $type;

    public function addRule(){
        return [
            [['page','type'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){


        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_msglog');
        $obj->setOrderBy('dateline desc');
        $obj->setWhere(['msgtype='=>$form->type,' and phone='=>$phone]);
        $obj->setPageNum($form->page);
        $obj->setFields('FROM_UNIXTIME(dateline,\'%Y-%m-%d %H:%i:%s\') as dateline,msgtouser');
        return $obj->get_list();
    }

}