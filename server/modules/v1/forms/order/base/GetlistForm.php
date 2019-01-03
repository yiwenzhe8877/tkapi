<?php

namespace app\modules\v1\forms\order\base;



use app\componments\sql\SqlGet;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $pageNum;
    public $status;
    public $type;


    public function addRule(){
        return [
            [['pageNum','type','status'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){

        $status=$form->status;
        $type=$form->type;
        $phone= Base::getUserPhone();

        //a
        if($type==1){
            $arr['phone=']=$phone;
        }

        //b
        if($type==2){
            $arr['p_phone=']=$phone;
        }

        //c
        if($type==3){
            $arr['s_phone=']=$phone;
        }

        if($status==0){
            $status='';
        }
        if($status==1){
            $status='订单付款';
        }
        if($status==2){
            $status='订单结算';
        }
        if($status==3){
            $status='订单失效';
        }

        if($status!=''){
            $arr[' and status=']=$status;
        }


        $obj=new SqlGet();
        $obj->setTableName('tkuser_order');
        $obj->setOrderBy('id desc');
        $obj->setWhere($arr);
        $obj->setFields('orderid,phone,FROM_UNIXTIME(createtime,\'%Y-%m-%d %H:%i:%s\') as createTime');
        $obj->setPageNum($form->pageNum);

        return $obj->get_list();
    }

}