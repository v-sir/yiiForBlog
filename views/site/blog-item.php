<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models;
use yii\data\Pagination;
use yii\widgets\LinkPager;

$tid=Yii::$app->request->get('tid');
$like=Yii::$app->request->get('like');
$dislike=Yii::$app->request->get('dislike');
$user_id=Yii::$app->request->get('user_id');
$viewCount=new models\Stat();
$viewCount->view($tid,$like,$dislike);
$getView=$viewCount->getView($tid);

$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;
$Article=new models\Article();
$Article=$Article->getArticle($tid);

$info=$Article;
$headImgURL=new models\UserInfo;
$UserInfo=new models\UserInfo;
$headImgURL=$headImgURL->getHeadImgUrl($user_id);
$UserInfo=$UserInfo->getUserInfo($user_id);

$commentInfo=new models\Comment();
$commentInfo=$commentInfo->getComment($tid);
$count=count($commentInfo);
$pagination = new Pagination([
    'defaultPageSize' => 5,
    'totalCount' =>  $count,
]);
$commentInfo=new models\Comment();
$commentInfo=$commentInfo->getComment($tid,$pagination->offset,$pagination->limit);

if(empty($headImgURL)) $headImgURL='./image/noHeadImg.jpg';



?>

<script>
    uParse('.content',{
        'rootPath': 'ueditor'
    });
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }
    function likeButton(){
        var tid=getUrlParam('tid');


        $.ajax({
            type: 'GET',
            url:  'index.php?r=site/blogitem&like=1&tid='+tid,
            dataType: 'json'

        });
        var html="<span><a href=\"#\" onclick=\"dislikeButton()\"> <i class=\"fa fa-thumbs-o-down fa-4x\"></i> Dislike</a></span>";
        document.getElementById("likeButton").innerHTML=html;

    }
    function dislikeButton(){
        var tid=getUrlParam('tid');


        $.ajax({
            type: 'GET',
            url:  'index.php?r=site/blogitem&like=2&tid='+tid,
            dataType: 'json'

        });
        var html="<span><a href=\"#\" onclick=\"likeButton()\"> <i class=\"fa fa-thumbs-o-up fa-4x\"></i> Like</a></span>";
        document.getElementById("likeButton").innerHTML=html;

    }


</script>


<section id="blog" class="container">
        <div class="center">
            <h2>Blogs</h2>
            <p class="lead">Let we think somthing!</p>
        </div>

        <div class="blog">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-item">
                        <img class="img-responsive img-blog" src="images/blog/blog1.jpg" width="100%" alt="" />
                            <div class="row">
                                <div class="col-xs-12 col-sm-2 text-center">
                                    <div class="entry-meta">
                                        <span id="publish_date"><?=date('j M',$info['create_at'])?></span>
                                        <span><i class="fa fa-user"></i> <a href="#"><?=$info['author']?></a></span>
                                        <span><i class="fa fa-comment"></i> <a href="#"><?= $count?> Comments</a></span>
                                        <span><i class="fa fa-heart"></i><a href="#" onclick="like()"><?=$getView['likeCount']?> Likes</a></span>
                                        <span><i class="fa fa-eye"></i><a href="#"><?=$getView['viewCount']?> Views</a></span>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-10 blog-content">
                                    <h2><?=$info['title'];?></h2>
                                    <div class='content'><?=$info['content'];?></div>
                                    <div class="post-tags">
                                    <div class="col-sm-5 " id="likeButton">
                                        <span><a href="#" onclick="likeButton()"> <i class="fa fa-thumbs-o-up fa-4x"></i> Like</a></span>
                                    </div>
                                    </div>
                                    <div class="post-tags">
                                        <strong>Tag:</strong> <a href="#">Cool</a> / <a href="#">Creative</a> / <a href="#">Dubttstep</a>
                                    </div>

                                </div>
                            </div>
                        </div><!--/.blog-item-->

                        <div class="media reply_section">
                            <div class="pull-left post_reply text-center">
                                <a href="#"><img src="<?=$headImgURL?>" class="img-circle" alt="" /></a>
                           <!--     <ul>
                                    <li><a href="#"><i class="fa fa-facebook">QQ</i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i> </a></li>
                                </ul>-->
                            </div>
                            <div class="media-body post_reply_content">
                                <h3><?=$UserInfo['name']?></h3>
                                <p class="lead"><?=$UserInfo['motto']?></p>
                                <p><strong>Mail:</strong> <a href="#"><?=$UserInfo['email']?></a></p>
                            </div>
                        </div>

                        <h1 id="comments_title"><?= $count?> Comments</h1>
                    <?php foreach ($commentInfo as &$commInfo){?>
                        <div class="media comment_section">
                            <div class="pull-left post_comments">
                                <a href="#"><img src='<?=$commInfo['headImgURL']?> 'class="img-circle" alt="" /></a>
                            </div>
                            <div class="media-body post_reply_comments">
                                <h3><?=$commInfo['nickname']?></h3>
                                <h4><?=date('M j,Y h:i:s A',$commInfo['create_at'])?></h4>
                                <div class='content'><?=$commInfo['message'];?></div>

                                <a href="#form-comment">Reply</a>
                            </div>
                        </div>
                    <?php }
                   ?>
                    <?= LinkPager::widget(['pagination'=>$pagination]) ?>



                        <div id="contact-page clearfix">
                            <div class="status alert alert-success" style="display: none"></div>
                            <div class="message_heading">
                                <h4>Leave a Replay</h4>
                                <p>I am very happy to talk with you!</p>
                            </div>

                            <?php $form = ActiveForm::begin(['id' => 'form-comment','class'=>'comment-form','action'=>"index.php?r=site/comment&tid=".$info['tid']]); ?>
                                <div class="row">
                                    <div class="col-sm-3 col-sm-offset-1">
                                        <div class="form-group">


                                            <?= $form->field($Comment, 'nickname')->label('*nickname')->textInput(['autofocus' => true]) ?>

                                        </div>


                                    </div>
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <?= Html::label('*Message')?>
                                        <script id="container" name="CommentForm[message]" type="text/plain">

                                        </script>
                                        <!-- 配置文件 -->
                                        <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
                                        <!-- 编辑器源码文件 -->
                                        <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
                                        <!-- 实例化编辑器 -->
                                        <script type="text/javascript">
                                            var ue = UE.getEditor('container',{maximumWords:500});
                                        </script>
                                    </div>



                                 </div>


                                <div class="col-sm-3 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div><!--/#contact-page-->
                    </div><!--/.col-md-8-->

                <aside class="col-md-4">
                    <div class="widget search">
                        <form role="form">
                                <input type="text" class="form-control search_box" autocomplete="off" placeholder="Search Here">
                        </form>
                    </div><!--/.search-->

    				<div class="widget categories">
                        <h3>Recent Comments</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="single_comments">
    								<img src="images/blog/avatar3.png" alt=""  />
    								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                    <div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span ><span>On <a href="#">Creative</a></span>
                                    </div>
    							</div>
    							<div class="single_comments">
    								<img src="images/blog/avatar3.png" alt=""  />
    								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
    								<div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span ><span>On <a href="#">Creative</a></span>
                                    </div>
    							</div>
    							<div class="single_comments">
    								<img src="images/blog/avatar3.png" alt=""  />
    								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
    								<div class="entry-meta small muted">
                                        <span>By <a href="#">Alex</a></span ><span>On <a href="#">Creative</a></span>
                                    </div>
    							</div>

                            </div>
                        </div>
                    </div><!--/.recent comments-->


                    <div class="widget categories">
                        <h3>Categories</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="blog_category">

                                    <li><a href="#">life <span class="badge">10</span></a></li>
                                    <li><a href="#">JXOnline3 <span class="badge">06</span></a></li>
                                    <li><a href="#">Technology <span class="badge">25</span></a></li>
                                    <li><a href="#">Other <span class="badge">04</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.categories-->

    				<div class="widget archieve">
                        <h3>Archieve</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="blog_archieve">
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> December 2013 <span class="pull-right">(97)</span></a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> November 2013 <span class="pull-right">(32)</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> October 2013 <span class="pull-right">(19)</a></li>
                                    <li><a href="#"><i class="fa fa-angle-double-right"></i> September 2013 <span class="pull-right">(08)</a></li>
                                </ul>
                            </div>
                        </div>
                    </div><!--/.archieve-->

                    <div class="widget tags">
                        <h3>Tag Cloud</h3>
                        <ul class="tag-cloud">
                            <li><a class="btn btn-xs btn-primary" href="#">Apple</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Barcelona</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Office</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Ipod</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Stock</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Race</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">London</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Football</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Porche</a></li>
                            <li><a class="btn btn-xs btn-primary" href="#">Gadgets</a></li>
                        </ul>
                    </div><!--/.tags-->

    				<div class="widget blog_gallery">
                        <h3>Our Gallery</h3>
                        <ul class="sidebar-gallery">
                            <li><a href="#"><img src="images/blog/gallery1.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/blog/gallery2.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/blog/gallery3.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/blog/gallery4.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/blog/gallery5.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/blog/gallery6.png" alt="" /></a></li>
                        </ul>
                    </div><!--/.blog_gallery-->


                </aside>

            </div><!--/.row-->

         </div><!--/.blog-->

    </section><!--/#blog-->
