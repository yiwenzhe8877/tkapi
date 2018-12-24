<?php

namespace app\models\goods;

use app\modules\v1\utils\CodeMsgMap;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use yii\web\IdentityInterface;

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
class category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tk_goods_category';
    }


}
