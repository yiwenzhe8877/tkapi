<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model classes for table "tk_group_auth".
 *
 * @property int $group_id 管理组id
 * @property string $auth_id 权限id
 *
 * @property AdminAuth $auth
 * @property AdminGroup $group
 */
class groupauth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_admin_groupauth';
    }

}
