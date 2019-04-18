<?php

namespace app\modules\v1\forms\money\base;



use app\componments\common\CommonForm;
use app\componments\sql\SqlGet;
use app\models\tkuser\Base;

class WithDrawLogForm extends CommonForm
{

    public $page;
    public $status;


    public function addRule(){
        return [
            [['status','page'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){

        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_withdrawlog');
        $obj->setOrderBy('dateline desc');
        $arr=['phone='=>$phone];
        if($form->status!=4){
            $arr[' and status=']=$form->status;
        }

        $obj->setFields('FROM_UNIXTIME(dateline,\'%Y-%m-%d %H:%i:%s\') as dateline,phone,money,remark,status');
        $obj->setWhere($arr);
        $obj->setPageNum($form->page);
        return $obj->get_list();

    }


}