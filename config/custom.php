<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

define('yiiForBlog_DEBUG_ENABLE', true);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
defined('WEBHOOK_GITLAB') or define('WEBHOOK_GITLAB', 'HTTP_X_GITLAB_TOKEN');
defined('WEBHOOK_GITHUB') or define('WEBHOOK_GITHUB', 'X-Hub-Signature');

return [
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
        ],
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=bbs',
            'username' => 'root',
            'password' => 'hehe.233.666',
            'slaveConfig' => [
                'username' => 'root',
                'password' => '',
            ],
        ],
    ],
];
