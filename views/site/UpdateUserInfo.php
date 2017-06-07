<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use \app\models\UserInfo;


$this->title = 'CompleteMaterial';
$this->params['breadcrumbs'][] = $this->title;
$headImgURL=new UserInfo;
$info=new UserInfo;
if(Yii::$app->user->isGuest ){
    $headImgURL='./image/noHeadImg.jpg';
    }
    else{
    $headImgURL=$headImgURL->getHeadImgUrl(Yii::$app->user->identity->getId());
    $info=$info->getUserInfo(Yii::$app->user->identity->getId());



    }


if(empty($headImgURL)) $headImgURL='./image/noHeadImg.jpg';
if($info['sex']==0)



/* @var $this yii\web\View */
/* @var $userInfo app\models\UserInfo */
/* @var $form ActiveForm */
?>
<section id="info-page">
    <div class="container">
        <div class="center">
            <h2>MY personal center</h2>
            <p class="lead">YOU can update it anytime!</p>
        </div>
        <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <div class="col-sm-3 col-sm-offset-4">
            <?php $form = ActiveForm::begin(['id' => 'form-UpdateUserInfo'],['options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($userInfo, 'UploadHeadImg')->label('UploadHeadImg')->fileInput(['onchange'=>"javascript:setImagePreview()",'wight'=>'200px','height'=>'200px','value'=>$headImgURL])?>

            <div id="img" class="localimg">
                <img id="preview" width=-1 height=-1 style="diplay:none" />
            </div>
            <?= Yii::$app->user->isGuest ? Html::img('./image/timg.jpg',['wight'=>'200px','height'=>'200px','alt'=>"添加图片",'id'=>'em-img'])
                : Html::img($headImgURL,['wight'=>'200px','height'=>'200px','alt'=>"添加图片",'id'=>'em-img'])


            ?>

            <?= $form->field($userInfo, 'user_id')->label('user_id') ->textInput(['value'=>Yii::$app->user->identity->getId(),'disabled'=>'disabled'])?>
            <?= $form->field($userInfo, 'name') ->label('name')->Input('text',['value'=>$info['name']])?>


            <?= Html::label('sex')?>
            <?php
            if($info['sex']==0){
                echo  $form->field($userInfo, 'sex') ->label('Man')->radio(['checked='=>'checked']);
                echo  $form->field($userInfo, 'sex') ->label('Feman')->radio();

            }
            else{
                echo  $form->field($userInfo, 'sex') ->label('Man')->radio();
                echo $form->field($userInfo, 'sex') ->label('Feman')->radio(['checked='=>'checked']);
            }



            ?>
            <?= $form->field($userInfo, 'tel')->label('tel') ->textInput(['value'=>$info['tel']])?>
            <?= $form->field($userInfo, 'qq') ->label('qq')->textInput(['value'=>$info['qq']])?>
            <?= $form->field($userInfo, 'email') ->label('email')->textInput(['value'=>$info['email']])?>
            <?= $form->field($userInfo, 'motto') ->label('motto')->textInput(['value'=>$info['motto']])?>
            <?= $form->field($userInfo, 'birthday')->label('birthday')->textInput(['value'=>$info['birthday']]) ?>

            <?= $form->field($userInfo, 'verifyCode')->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-5">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</section>
