<?php
/**
 * Created by PhpStorm.
 * adminUser: admin
 * DateUtils: 2018/7/23
 * Time: 17:20
 */

namespace app\componments\common;


use yii\base\Model;

class CommonForm extends Model
{
    public function rules()
    {
        return array_merge($this->getRules(FORM_CLASS),$this->addRule());
    }


    public function addRule(){
        return [];
    }

    public function getRules($class){
        $rules=$this->myrules();
        $arr= get_class_vars($class);

        $result=[];
        foreach ($arr as $k=>$v){
            foreach ($rules as $n){
                if($n[0]==$k){
                    array_push($result,$n);
                }
            }
        }
        return $result;

    }


    public function myrules()
    {
        return [

        ];
    }

    //返回第一个错误信息
    public function getError()
    {
        if(empty($this->errors))
        {
            return "";
        }
        $errors = $this->errors;
        $error = array_shift($errors);
        return $error[0];
    }
}