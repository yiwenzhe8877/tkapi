<?php
/**
 * Created by PhpStorm.
 * adminUser: idz025
 * DateUtils: 2018/10/26
 * Time: 9:13
 */

namespace app\models\tkapi;


class Exceptionlog extends  \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return table_prefix().'tkapi_exceptionlog';
    }

}