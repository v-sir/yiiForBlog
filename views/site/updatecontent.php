<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models;
$this->title = 'UpdateContent';
$this->params['breadcrumbs'][] = $this->title;
$tid=Yii::$app->request->get('tid');
$Art=new models\Article();
$Art=$Art->getArticle($tid);

$info=$Art;

?>
<div id="hidden"  style="width: 200px; height:300px">
<?=$info['content']?>

</div>
<script src="ueditor/ueditor.parse.js"></script>
<script>

        document.getElementById("hidden").style.display="none";



</script>

<section id="addcontent-page">
    <div class="container">
        <div class="center">
            <h2>Begin Your Article</h2>
            <p class="lead">please fill the table.</p>
        </div>

        <div class="status alert alert-success" style="display: none"></div>
        <?php $form = ActiveForm::begin(['id' => 'form-addcontent','class'=>'addcontent-form']);?>
        <div class="col-sm-2 col-sm-offset-3">
            <?= $form->field($Article, 'title')->label('*title')->textInput(['autofocus' => true,'value'=>$info['title']]) ?>
            <?= $form->field($Article, 'description')->label('*description')->textInput(['autofocus' => true,'value'=>$info['description']]) ?>
        </div>
        <div class="col-sm-2 col-sm-offset-2">
            <?= $form->field($Article, 'author')->label('*author')->textInput(['autofocus' => true,'value'=>Yii::$app->user->identity->username]) ?>
            <?= Html::label('*articleType')?>
            <?=
            "<select name='AddContentForm[art_type]'>
                            <option value =0>0:original</option>
                            <option value =1>1:Reward for help </option>
                            <option value=2>2:reprinted</option>
                           
                    </select>"?>
        </div>

        <!-- 加载编辑器的容器 -->
        <div class="col-sm-10 col-sm-offset-1">
            <?= Html::label('*text')?>
            <script id="container" name="AddContentForm[content]" type="text/plain">


             </script>
            <!-- 配置文件 -->
            <script type="text/javascript" src="ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="ueditor/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">

                var content=  document.getElementById("hidden").innerHTML;
                console.log(content);
                var ueditor=UE.getEditor('container');
                ueditor.addListener("ready", function () {

                    ueditor.setContent(content);

                });




            </script>


        </div>
        <div class="col-sm-3 col-sm-offset-1">
            <?= $form->field($Article, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
        </div>
        <div class="col-sm-3 col-sm-offset-1">
            <?= Html::submitButton('addcontent', ['class' => 'btn btn-primary', 'name' => 'addcontent-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>









    </div><!--/.row-->

</section><!--/#contact-page-->