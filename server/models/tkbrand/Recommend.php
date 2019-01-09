<?php

namespace app\models\tkbrand;



class Recommend extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkbrand_recommend';
    }

}