<?php
/**
 * This file is part of the yiiForBlog.
 * @link http://weplay.ubadbad.cc/
 * @copyright Copyright (c) 2017 v-sir studio.
 */

namespace app\commands;

/**
 * crontab运行周期
 *
 * @author huangwei <hwstudio00@gmail.com>
 */
class CycleController
{
    private function exec($item, $log = null)
    {
        if ($log === null) {
            $log = '/dev/null';
        } else {
            $log = 'runtime/logs/' . $log;
        }
        $cmd = './yii ' . $item . ' > ' . $log . ' 2>&1 &';
        exec($cmd);
    }

}