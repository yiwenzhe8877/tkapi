<?php

namespace app\models\order;


class refunds extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_refunds';
    }

}
