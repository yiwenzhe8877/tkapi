<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model classes for table "tk_menu_group".
 *
 * @property int $menu_id 菜单id
 * @property int $group_id 用户组id
 *
 * @property AdminMenu $menu
 * @property AdminGroup $group
 */
class menugroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_admin_menugroup';
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(menu::className(), ['menu_id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(group::className(), ['group_id' => 'group_id']);
    }
}
