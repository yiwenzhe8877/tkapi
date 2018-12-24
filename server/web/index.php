<?php



//跨域


if(isset($_SERVER["HTTP_ORIGIN"])) {
    header('Access-Control-Allow-Origin:*');
}


header('Access-Control-Allow-Methods:OPTIONS, GET, POST');
header('Access-Control-Allow-Headers: X-Requested-With,X_Requested_With,service,token,Content-Type');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    exit;
}



// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

defined('APP_PATH')or define('APP_PATH', '../');
defined('DATA_PATH')or define('DATA_PATH', APP_PATH.'data/');
defined('IMG_PATH')or define('IMG_PATH', '../data/images/');



require(__DIR__ . '/../functions.php');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
