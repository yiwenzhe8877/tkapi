<?php

namespace app\modules\v1\forms\member\setting;



use app\componments\duanxin\Mob;
use app\componments\sql\SqlUpdate;
use app\models\tkuser\Base;
use app\modules\v1\forms\CommonForm;

class SavezhifubaoForm extends CommonForm
{

    public $name;
    public $zhifubao;
    public $code;

    public function addRule(){
        return [
            [['name','zhifubao','code'],'required','message'=>'{attribute}不能为空'],
        ];
    }

    public function run($form){


        $phone=Base::getUserPhone();

        Mob::verify_code($phone,$form->code);


        $obj=new SqlUpdate();
        $obj->setTableName('tkuser_base');
        $obj->setData(['zhifubao'=>$form->zhifubao,'zhifubao_name'=>$form->name]);
        $obj->setWhere(['phone='=>$phone]);
        return $obj->run();

    }

}