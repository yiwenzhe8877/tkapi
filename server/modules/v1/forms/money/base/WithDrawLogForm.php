<?php

namespace app\modules\v1\forms\money\base;



use app\componments\common\CommonForm;
use app\componments\sql\SqlCreate;
use app\componments\sql\SqlGet;
use app\componments\sql\SqlUpdate;
use app\componments\utils\ApiException;
use app\componments\utils\PwdUtils;
use app\componments\utils\RandomUtils;
use app\models\tkuser\Base;
use app\models\tkuser\WithdrawLog;
use yii\db\Exception;

class WithDrawLogForm extends CommonForm
{

    public $pageNum;
    public $status;


    public function addRule(){
        return [
            [['status','pageNum'],'required','message'=>'提交的数据不能为空'],
        ];
    }

    public function run($form){

        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_withdrawlog');
        $obj->setOrderBy('id desc');
        $arr=['phone='=>$phone];
        if($form->status!=4){
            $arr[' and status=']=$form->status;
        }

        $obj->setFields('FROM_UNIXTIME(dateline,\'%Y-%m-%d %H:%i:%s\') as dateline,phone,money,remark,status');
        $obj->setWhere($arr);
        $obj->setPageNum($form->pageNum);
        return $obj->get_list();

    }


}