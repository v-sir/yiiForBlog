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
$this->title = 'Blog';
$this->params['breadcrumbs'][] = $this->title;

$Article=new models\Article();
$Article=$Article->getArticleByUserId();
$count=count($Article);
//var_dump($Article);
$pagination = new Pagination([
    'defaultPageSize' => 3,
    'totalCount' =>  $count,
]);
$Article=new models\Article();
$Article=$Article->getArticleByUserId($tid=null,$pagination->offset,$pagination->limit);

//var_dump($Article);


?>
<section id="blog" class="container">
    <div class="center">
        <h2>Blogs</h2>
        <p class="lead"><p class="lead">Let we think somthing!</p>
    </div>

    <div class="blog">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($Article as &$info){
                    $tid=$info['tid'];
                    $viewCount=new models\Stat();
                    $getView=$viewCount->getView($tid);





                    ?>

                <div class="blog-item">
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 text-center">
                            <div class="entry-meta">
                                <span id="publish_date">07  NOV</span>
                                <span><i class="fa fa-user"></i> <a href="#"><?=$info['author']?></a></span>
                                <span><i class="fa fa-comment"></i> <a href="#comments"><?=$getView['commentCount']?> Comments</a></span>
                                <span><i class="fa fa-heart"></i><a href="#"><?=$getView['likeCount']?> Likes</a></span>
                                <span><i class="fa fa-eye"></i><a href="#"><?=$getView['viewCount']?> Views</a></span>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-10 blog-content">
                            <a href="#"><img class="img-responsive img-blog" src="images/blog/blog1.jpg" width="100%" alt="" /></a>
                            <h2><a href="?r=site/blogitem"><?=$info['title']?></a></h2>
                            <h3><?=$info['description']?></h3>
                            <a class="btn btn-primary readmore" href="?r=site/blogitem&tid=<?=$info['tid']?>">Read More <i class="fa fa-angle-right"></i></a>
                        </div>

                    </div>
                </div><!--/.blog-item-->
                <?php  }?>
                <div class="col-sm-9 col-sm-offset-5"> <?= LinkPager::widget(['pagination'=>$pagination]) ?></div>
                <!--

                <ul class="pagination pagination-lg">
                    <li><a href="#"><i class="fa fa-long-arrow-left"></i>Previous Page</a></li>
                    <li class="active"><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">Next Page<i class="fa fa-long-arrow-right"></i></a></li>
                </ul>
                -->
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
                                    <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
                                </div>
                            </div>
                            <div class="single_comments">
                                <img src="images/blog/avatar3.png" alt=""  />
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                <div class="entry-meta small muted">
                                    <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
                                </div>
                            </div>
                            <div class="single_comments">
                                <img src="images/blog/avatar3.png" alt=""  />
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do </p>
                                <div class="entry-meta small muted">
                                    <span>By <a href="#">Alex</a></span <span>On <a href="#">Creative</a></span>
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
    </div>
</section><!--/#blog-->
