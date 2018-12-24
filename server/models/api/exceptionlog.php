<?php

namespace app\models\api;


class exceptionlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_api_exceptionlog';
    }

}
