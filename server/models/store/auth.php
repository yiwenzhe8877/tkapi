<?php

namespace app\models\store;


class auth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_store_auth';
    }

}
