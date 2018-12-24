<?php

namespace app\models\order;


class delivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_delivery';
    }

}
