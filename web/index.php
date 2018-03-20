<?php
// 定义项目根目录
define('ROOT', dirname(__DIR__));

// 初始化YII_ENV
if (isset($_SERVER['YII_ENV'])
    && in_array($_SERVER['YII_ENV'], array('prod', 'stage', 'test', 'dev'), true)
) {
    define('YII_ENV', $_SERVER['YII_ENV']);
} else {
    define('YII_ENV', 'prod');
}

// 初始化YII_ENV_STAGE
define('YII_ENV_STAGE', YII_ENV === 'stage');

// 初始化YII_DEBUG
if (YII_ENV === 'dev') {
    // 开启调试
    define('YII_DEBUG', true);
} else {
    define('YII_DEBUG', false);
}

// 初始化Composer自动加载
require(ROOT . '/vendor/autoload.php');
// 加载Yii类、初始化Yii
require(ROOT . '/vendor/yiisoft/yii2/Yii.php');

// 获取配置
$config = require(ROOT . '/config/web.php');

// 应用构建、运行
(new yii\web\Application($config))->run();



