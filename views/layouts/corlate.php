<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= Html::csrfMetaTags() ?>
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <style>
        .black_overlay{
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index:1001;
            -moz-opacity: 0.8;
            opacity:.80;
            filter: alpha(opacity=88);
        }
        .white_content {
            display: none;
            position: absolute;
            top: 25%;
            left: 25%;
            width: 55%;
            height: 55%;
            padding: 20px;
            border: 10px solid #999999;
            background-color: white;
            z-index:1002;
            overflow: auto;
        }
    </style>

	<!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="ueditor/ueditor.parse.js" type="text/javascript"></script>
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-4">
                        <div class="top-number"><p><i class="fa fa-phone-square"></i>  13087211367</p></div>
                    </div>
                    <div class="col-sm-6 col-xs-8">
                       <div class="social">
                            <ul class="social-share">

                                <li><a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><i class="fa fa-qq">qq</i></a></li>
                                <li><a target="_blank" href="http://weibo.com/1801439974/profile?topnav=1&wvr=6&is_all=1"><i class="fa fa-weibo"></i></a></li>
                                <li><a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><i class="fa fa-weixin fa-4" aria-hidden="true">weixin</i></a></li>
                                <li><a href="javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><i class="fa fa-">支</i></a></li>
                                <li><a target="_blank" href="https://github.com/v-sir"><i class="fa fa-github"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="image/logo.png" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <?php
                        echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => [
                        ['label' => 'Home', 'url' => ['/site/index']],
                        ['label' => 'Blog', 'url' => ['/site/blog']],
                       // ['label' => 'About', 'url' => ['/site/about']],
                        ['label' => 'Contact', 'url' => ['/site/contact']],
                        Yii::$app->user->isGuest ? (
                                ['label' => 'Login/Signup', 'url' => ['/site/login']]



                        ) : (


                        '<li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-o"></i>Personal<i class="fa fa-angle-down"></i></a>
                             
                                <ul class="dropdown-menu">'


                            . Html::beginForm(['/site/upinfo'], 'post')
                            . Html::submitButton(
                             Yii::$app->user->identity->username ,
                            ['class' => 'btn btn-link upinfo']
                            )
                        . Html::endForm()
                        . Html::beginForm(['/site/addcontent'], 'post')
                        . Html::submitButton(
                            'Add Content' ,
                            ['class' => 'btn btn-link addcontent']
                        )
                            . Html::endForm()
                        . Html::beginForm(['/site/articlelist'], 'post')
                        . Html::submitButton(
                            'My Article' ,
                            ['class' => 'btn btn-link articlelist']
                        )
                        . Html::endForm()
                             .Html::beginForm(['/site/logout'], 'post')
                            . Html::submitButton(
                                'Logout' ,
                                ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()



                            . '</ul>'

                        . '</li>'
                        )
                        ],
                        ]);?>


                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->

    </header><!--/header-->

    <?php $this->beginBody() ?>

    <div id="light" class="white_content">
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">X</a>
        <img src="./image/alipay.jpg" width="200px" height="320px">
        <img src="./image/wechat.png" width="200px" height="320px">
        <img src="./image/qq.jpg" width="200px" height="320px">
    </div>
    <div id="fade" class="black_overlay"></div>
    <?=$content?>
    <?php $this->endBody() ?>

    <section id="bottom">
        <div class="container wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>About</h3>
                        <ul>
                            <li><a href="#features">About me</a></li>
                            <li><a href="#">My blog</a></li>
                            <li><a href="#">My site</a></li>
                            <li><a target="_blank" href="https://github.com/v-sir">MY Github</a></li>

                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Support</h3>
                        <ul>
                            <li><a target="_blank" href="http://php.net/">php</a></li>
                            <li><a target="_blank" href="http://www.bootcss.com/">Bootstrap</a></li>
                            <li><a target="_blank" href="http://www.yiiframework.com/">Yii</a></li>
                            <li><a target="_blank" href="http://fontawesome.io/">Font Awesome</a></li>
                            <li><a target="_blank" href="http://shapebootstrap.net/demo/html/corlate/">Corlate</a></li>
                            <li><a target="_blank" href="http://www.xunsearch.com/">xunsearch</a></li>
                            <li><a target="_blank" href="http://ueditor.baidu.com/website/">Ueditor</a></li>
                            <script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1262125724'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s19.cnzz.com/z_stat.php%3Fid%3D1262125724%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Recommended links</h3>
                        <ul>
                            <li><a target="_blank" href=" https://haimanchajian.com/">海鳗插件</a></li>
                            <li><a target="_blank" href="https://www.sky31.com/">Sun-e Studio</a></li>
                            <li><a target="_blank" href="https://radio.sky31.com/">Xtu Radio</a></li>
                            <li><a target="_blank" href="https://www.sky31.com/xdspc/">Xtu Video</a></li>
                            <li><a target="_blank" href="https://movie.sky31.com/">Xtu movies</a></li>
                            <li><a target="_blank" href="https://buy.sky31.com/">Xtu Secondhand market</a></li>
                            <li><a target="_blank" href="https://doc.sky31.com/">Xtu doc</a></li>

                        </ul>
                    </div>
                </div><!--/.col-md-3-->

                <div class="col-md-3 col-sm-6">
                    <div class="widget">
                        <h3>Blogs & githubs</h3>
                        <ul>
                            <li><a target="_blank" href="https://github.com/linroid">linroid's Github</a></li>
                            <li><a target="_blank" href="https://github.com/hightman">hightman's Github</a></li>
                            <li><a target="_blank" href="https://return0.cc/">Andreas's Blog</a></li>
                            <li><a target="_blank" href="http://www.zhangshirong.com/blog/">Jarvis's Blog</a></li>
                            <li><a target="_blank" href="https://github.com/andreas39">Andreas's Github</a></li>
                            <li><a target="_blank" href="https://github.com/imzhangshirong">Jarvis's Github</a></li>
                            <li><a target="_blank" href="https://github.com/slight-sky">slight-sky's Github</a></li>
                        </ul>
                    </div>
                </div><!--/.col-md-3-->
            </div>
        </div>
    </section><!--/#bottom-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2014-<?= date('Y') ?> <a target="_blank" href="http://ubadbad.cc/" title="Learn with Mr.wei">Ubadbad.cc</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Faq</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->


    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>

