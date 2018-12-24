<?php

namespace app\models\goods;


/**
 * This is the model classes for table "tk_user".
 *
 * @property int $user_id 管理员id
 * @property string $username 管理员账号名
 * @property string $password 管理员密码
 * @property string $nickname 昵称
 * @property string $phone 手机号
 * @property int $group_id 管理组id
 * @property string $auth_key 密钥
 *
 * @property AdminUserGroup[] $userGroups
 */
class logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_goods_logs';
    }


}
