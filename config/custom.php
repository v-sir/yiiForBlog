<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

define('yiiForBlog_DEBUG_ENABLE', true);
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

return [
    'components' => [
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
