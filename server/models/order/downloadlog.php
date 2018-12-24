<?php

namespace app\models\order;


class downloadlog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_downloadlog';
    }

}
