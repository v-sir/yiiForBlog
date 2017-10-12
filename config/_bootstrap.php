<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

//载入自定义配置文件
$customFile = __DIR__ . '/custom.php';
$customConfig = file_exists($customFile) ? require $customFile : [];

//载入yii框架
defined('YII_BASE_PATH') or define('YII_BASE_PATH', dirname(__DIR__));
require YII_BASE_PATH . '/vendor/autoload.php';
require YII_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php';

//载入应用配置文件
if (!isset($configFile)) {
    $configFile = __DIR__ . '/web.php';
}

//加载配置
$config = \yii\helpers\ArrayHelper::merge($customConfig, require $configFile);
return $config;