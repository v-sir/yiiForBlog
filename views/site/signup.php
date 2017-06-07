<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;


$this->title = 'signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="signup-page">
    <div class="container">
        <div class="center">
            <h2>Signup Your Info</h2>
            <p class="lead">please fill the table.</p>
        </div>

            <div class="status alert alert-success" style="display: none"></div>
            <?php $form = ActiveForm::begin(['id' => 'form-signup','class'=>'signup-form']); ?>
            <div class="col-sm-5 col-sm-offset-3">
                <div class="form-group">


                     <?= $form->field($model, 'username')->label('username')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'password')->label('password')->passwordInput() ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                </div>





            <div class="form-group">
                <?= Html::submitButton('signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
            </div>

        </div><!--/.row-->

</section><!--/#contact-page-->
