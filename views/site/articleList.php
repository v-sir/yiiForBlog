<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models;

$this->title = 'ArticleList';
$this->params['breadcrumbs'][] = $this->title;
$Article=new models\Article();
$id=Yii::$app->user->getId();
$Article=$Article->getArticleByUserId($id);

?>
<div class="row show-it">
    <div class="col-md-12 column">
        <center><div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Article center</h3>
                </div>
                <div class="panel-body">
                    <a href="user.php?select=gs" class="btn btn-info">All Articles</a>&nbsp;&nbsp;&nbsp;<a href="user.php?select=bz" class="btn btn-warning">My Article</a>
                </div>
            </div></center>
<table class="table table-striped table-bordered white-bg">

    <tr>
        <th>tid</th>
        <th>title</th>
        <th>author</th>
        <th>description</th>
        <th>art_type</th>
        <th>cid</th>
        <th>create_at</th>
        <th>update_at</th>
        <th>state</th>
        <th>state</th>
    </tr>
    <?php

    foreach ($Article as &$Artinfo){
        $tid=$Artinfo['tid'];




        echo"
     <tr>
        <td>$tid</td>
        <td>$Artinfo[title]</td> 
        <td>$Artinfo[author]</td>
        <td>$Artinfo[description]</td>
        <td>";
        switch($Artinfo['art_type']){
            case 0:
                echo "original";
                break;
            case 1:
                echo "Reward for help";
                break;
            case 2:
                echo "reprinted";
                break;

        }


            echo"</td>
        <td>$Artinfo[cid]</td>
        
        <td>".date('Y-m-d H:i:s ',$Artinfo['create_at'])."</td>
         <td>".date('Y-m-d H:i:s ',$Artinfo['update_at'])."</td>
     
        <td>";switch($Artinfo['state']){
            case 0:
                echo "not audited";
                break;
            case 1:
                echo "normal";
                break;
            case 2:
                echo "deleted";
                break;
            default:
                echo "The audit did not pass";

        }
        echo"</td>
        <td><a href='?r=site/updatecontent&tid=$tid' class='btn btn-danger btn-xs'>update</a>&nbsp;&nbsp;&nbsp;<a href='userProcess.php?action=delete&uid=1&name=张施荣' class='btn btn-danger btn-xs'>delete</a>&nbsp;&nbsp;&nbsp;<a href='hw.php?uid=1' class='btn btn-warning btn-xs'>display</a>&nbsp;&nbsp;&nbsp;
        <a href='sms.php?&phone=15197275590' class='btn btn-success btn-xs'>Not pass</a>
         <a href='?r=site/blogitem&tid=$tid'class='btn btn-info  btn-xs'>View</a></td>

    </tr>";
    }
    ?>




</table>
    </div>
</div>