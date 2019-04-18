<?php

namespace app\modules\v1\forms\member\earning;


use app\componments\common\CommonForm;
use app\componments\utils\DateUtils;
use app\models\tkuser\Base;
use app\models\tkuser\Order;

class GeneralForm extends CommonForm
{


    public function run(){

        $start=DateUtils::get_day_startline();
        $end=DateUtils::get_day_endline();


        $phone = Base::getUserPhone();

        $my_today_model=Order::find()
            ->where(['>','createtime',$start])
            ->andWhere(['<','createtime',$end])
            ->andWhere(['=','phone',$phone]);


        $my_today_count=$my_today_model->count();
        $my_today_sum=$my_today_model->sum('cuscommission');

        $my = $this->getEarningInfo($start,$end,$phone);




        $yes_start=$start-(24*60*60*2);
        $yes_end=$start-(24*60*60);
        $my_yes_model=Order::find()
            ->where(['>','createtime',$yes_start])
            ->andWhere(['<','createtime',$yes_end])
            ->andWhere(['=','phone',$phone]);



        $my_yes_count=$my_yes_model->count();
        $my_yes_sum=$my_yes_model->sum('cuscommission');




        return [
            'today_count'=>$my_today_count,
            'today_sum'=>$my_today_sum,
            'yes_count'=>$my_yes_count,
            'yes_sum'=>$my_yes_sum,
        ];
    }

    public function getEarningInfo($start,$end,$phone_field,$phone){
        $my_today_model=Order::find()
            ->where(['>','createtime',$start])
            ->andWhere(['<','createtime',$end])
            ->andWhere(['=',$phone_field,$phone]);

        $count=$my_today_model->count();
        $sum=$my_today_model->sum('cuscommission');
        $sum= ($sum==null)?$sum:0;

        return ['count'=>$count,'sum'=>$sum];
    }

}