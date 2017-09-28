<?php
/**
 * yiiForBlog - web 入口
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

$config = require __DIR__ . '/../config/_bootstrap.php';
(new yii\web\Application($config))->run();
