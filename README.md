炜博 (based on Yii2)
===========================
炜博，基于 [Yii2](http://www.yiiframework.com) 的博客系统，是我在学习 yii2设计思想的一次应用。

自动部署测试站：<https://dev.ubadbad.cc/blog/v-dev>
[![build status](http://https://github.com/v-sir/yiiForBlog)](https://github.com/v-sir/yiiForBlog)

[源码仓库](https://github.com/v-sir/yiiForBlog)
[代码风格](https://github.com/yiisoft/yii2/blob/master/docs/internals/core-code-style.md)


UPDATE LOGS
-----------

    2017.06.08 21:13     	     已经完成了，基本站点框架的搭建。在后台系统已经可以支持博客版块的发布和编辑情况,
                            已经架设了评论系统
                            
    2017.06.13 21:26          修负了blog展示页面的BUG， 包含时间的展示问题更正服务器的时区等。
    
    2017.10.11 22:40          部署自动化测试站
    
DIRECTORY STRUCTURE
-------------------

    assets/             contains assets definition
    config/             contains application configurations
    controllers/        contains web controller classes
    models/             contains common model classes
    runtime/            contains files generated during runtime
    static/             contains static resource files
    vendor/             contains dependent 3rd-party packages
    views/              contains view files for the web application
    web/                contains the entry script and web resources


REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

请在工作环境安装好 composer 并克隆仓库至本地环境。

### 安装第三方依赖

~~~
composer global require "fxp/composer-asset-plugin:*"
composer install
~~~

### 修改配置




### 数据库




### 升级第三方依赖

~~~
composer update
~~~

You can then access the application through the following URL:

~~~
http://localhost/yiiForBlog/
~~~

### 本地快速测试

新建一个用于测试的文件在web目录下
~~~
<?php return !file_exists($_SERVER['SCRIPT_FILENAME']) && require __DIR__ . '/debug.php';
~~~

快速测试
~~~
php -S localhost:9999 -t web web/test.php
~~~
