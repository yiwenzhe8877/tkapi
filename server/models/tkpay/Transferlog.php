<?php

namespace app\models\tkpay;


use app\componments\sql\SqlGet;

class Transferlog extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkpay_transferlog';
    }

}