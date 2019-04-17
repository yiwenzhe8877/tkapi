<?php

namespace app\modules\v1\forms\member\myteam;

use app\componments\sql\SqlCreate;

use app\componments\sql\SqlGet;
use app\componments\utils\CommonUtils;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class GetTeamForm extends CommonForm
{
    public $page;
    public $status;

    public function addRule(){
        return [
            [["page","status"],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){

        $phone=Base::getUserPhone();

        $obj=new SqlGet();
        $obj->setTableName('tkuser_base');
        $obj->setOrderBy('jointime desc');
        $obj->setPageNum($form->page);
        $obj->setFields("group_name,phone,headingimgurl,FROM_UNIXTIME(jointime,'%Y-%m-%d') as time");
        if($form->status==1){
            $obj->setWhere(['p_phone='=>$phone]);
        }
        if($form->status==2){
            $obj->setWhere(['s_phone='=>$phone]);
        }

        $d=$obj->get_list();

        $list=$d['list'];
        for ($i=0;$i<count($list);$i++){
            $list[$i]['phone']=CommonUtils::hidephone($list[$i]['phone']);
        }

        $d['list']=$list;

        return $d;
    }
}