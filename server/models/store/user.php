<?php

namespace app\models\store;


class user extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_store_user';
    }

}
