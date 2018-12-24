<?php

namespace app\modules\v2;

/**
 * v2 module definition classes
 */
class v2 extends \yii\base\Module
{
    /**
     * @inheritdoc
     */


    public function init()
    {
        parent::init();


        //加载模块配置文件
        \Yii::configure($this, require(__DIR__ . '/config/config.php'));
    }
}
