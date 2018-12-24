<?php

namespace app\models\order;


class base extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_base';
    }

}
