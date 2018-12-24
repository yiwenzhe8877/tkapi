<?php

namespace app\models\member;


class baseinfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_member_baseinfo';
    }

}
