<?php

namespace app\models\order;


class deliveryitems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_deliveryitems';
    }

}
