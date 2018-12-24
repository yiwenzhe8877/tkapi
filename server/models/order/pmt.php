<?php

namespace app\models\order;


class pmt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_order_pmt';
    }

}
