<?php

namespace app\modules\v1\forms\order\base;



use app\componments\sql\SqlGet;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class GetListForm extends CommonForm
{

    public $page;
    public $status;
    public $type;


    public function addRule(){
        return [
            [['page','type','status'],'required','message'=>'{attribute}不能为空'],
        ];
    }


    public function run($form){

        $status=$form->status;
        $type=$form->type;
        $phone= Base::getUserPhone();

        //a
//        if($type==1){
//            $arr['phone=']=$phone;
//        }
//
//        //b
//        if($type==2){
//            $arr['p_phone=']=$phone;
//        }
//
//        //c
//        if($type==3){
//            $arr['s_phone=']=$phone;
//        }

        $arr[' (phone=']=$phone;
        //$arr[' or p_phone=']=$phone;
        //$arr[' or s_phone=']=$phone;

        if($status==1){
            $status='';
        }
        if($status==2){
            $status='订单付款';
        }
        if($status==3){
            $status='订单结算';
        }
        if($status==4){
            $status='订单失效';
        }

        if($status!=""){
            $arr[') and status=']=$status;
        }else{
            $arr[') and id>']='0';
        }

        $obj=new SqlGet();
        $obj->setTableName('tkuser_order');
        $obj->setOrderBy('createtime desc');
        $obj->setWhere($arr);
        $obj->setFields('orderid,FROM_UNIXTIME(createtime,\'%Y-%m-%d %H:%i:%s\') as createTime,goodspic,realpay,status,goodscnt,cuscommission');
        $obj->setPageNum($form->page);

        return $obj->get_list();
    }

}