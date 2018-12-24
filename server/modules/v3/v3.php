<?php

namespace app\modules\v3;

/**
 * v2 module definition class
 */
class v3 extends \yii\base\Module
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
