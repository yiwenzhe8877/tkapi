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
class sysmsg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_member_sysmsg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleCategories()
    {
        return $this->hasMany(ArticleCategory::className(), ['category_id' => 'category_id']);
    }
}
