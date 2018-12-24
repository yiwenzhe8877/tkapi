<?php

namespace app\models\article;


class category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_article_category';
    }

}
