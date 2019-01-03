<?php

namespace app\models\tkuser;


class FavGoods extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkuser_favgoods';
    }

}