<?php

namespace app\models\member;

use Yii;

/**
 * This is the model classes for table "tk_category".
 *
 * @property int $category_id 分类id
 * @property string $name 分类名称
 *
 * @property ArticleCategory[] $articleCategories
 */
class verify extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_member_verify';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

        ];
    }


}
