<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

$config = [
    'id' => 'yiiForBlog',
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
    'basePath' => YII_BASE_PATH,
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'e1bbc59f77fc15fe3c851ec1342799aa',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'tablePrefix' => 'bbs_',
            'charset' => 'utf8mb4',
            'enableSchemaCache' => !YII_DEBUG,
            'attributes' => [
                PDO::ATTR_PERSISTENT => true,
            ],
            'slaveConfig' => [
                'username' => 'root',
                'password' => '',
                'attributes' => [
                    PDO::ATTR_TIMEOUT => 1,
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'enableStrictParsing' => false,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [

    ],

];

//for dev
if (YII_ENV_DEV) {
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];
}

return $config;