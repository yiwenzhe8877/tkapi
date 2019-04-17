<?php

namespace app\modules\v1\forms\member\earning;


use app\componments\common\CommonForm;
use app\componments\utils\DateUtils;
use app\models\tkuser\Order;

class GeneralForm extends CommonForm
{


    public function run(){

        $start=DateUtils::get_day_startline();
        $end=DateUtils::get_day_endline();



        $today_model=Order::find()
            ->where(['>','createtime',$start])
            ->andWhere(['<','createtime',$end]);


        $today_count=$today_model->count();
        $today_sum=$today_model->sum('cuscommission');

        $yes_start=$start-(24*60*60*2);
        $yes_end=$start-(24*60*60);
        $yes_model=Order::find()
            ->where(['>','createtime',$yes_start])
            ->andWhere(['<','createtime',$yes_end]);



        $yes_count=$yes_model->count();
        $yes_sum=$yes_model->sum('cuscommission');
        $yes_sum=($yes_sum==null)?0:$yes_sum;
        $today_sum=($today_sum==null)?0:$today_sum;

        return [
            'today_count'=>$today_count,
            'today_sum'=>$today_sum,
            'yes_count'=>$yes_count,
            'yes_sum'=>$yes_sum,
        ];
    }

}