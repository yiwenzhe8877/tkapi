<?php

namespace app\models\api;


class log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_api_log';
    }

}
