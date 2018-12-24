<?php

namespace app\models\admin;

use Yii;

/**
 * This is the model classes for table "tk_group".
 *
 * @property int $group_id 管理组id
 * @property string $name 组名称
 * @property int $status 1表示启用,0表示关闭的
 *
 * @property AdminGroupAuth[] $groupAuths
 * @property AdminUserGroup[] $userGroups
 */
class group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_admin_group';
    }
    public function getGroupMenus(){
        return $this->hasMany(menugroup::className(),['group_id' => 'group_id']);
    }
}
