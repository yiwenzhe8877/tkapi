<?php

namespace app\models\tkuser;


class Order extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_order';
    }


}