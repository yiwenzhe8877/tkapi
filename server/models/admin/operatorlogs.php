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
class operatorlogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_admin_operatorlogs';
    }


}
