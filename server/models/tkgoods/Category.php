<?php

namespace app\models\tkgoods;



class Category extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkgoods_category';
    }

}