<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-3">
                    <h3>Address</h3>
                    <p>
                        KN 185 St, Kigali<br>
                        Nyakabanda Nyarugenge
                    </p>
                </div>

                <div class="col-sm-4">
                    <h3>Contact</h3>
                    <p>
                        <i class="fa fa-mobile-phone"></i> +250788590179<br>
                        <i class="fa fa-envelope-o"></i> <a href="mailto:">rwandaguide@rwandaguide.info</a>
                    </p>
                </div>

                <div class="col-sm-5">
                    <h3>Social Profiles</h3>

                    <ul class="social-links nav nav-pills">
                        <li><a href="<?php echo Yii::$app->params['twitter'] ?>" target="_blank"
                               title="Twitter"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['facebook'] ?>" target="_blank"
                               title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['google-plus'] ?>" target="_blank"
                               title="Google plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['tumblr'] ?>" target="_blank"
                               title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['instagram'] ?>" target="_blank"
                               title="Instagram"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['pinterest'] ?>" target="_blank"
                               title="Pinterest"><i class="fa fa-pinterest-p"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['flickr'] ?>" target="_blank"
                               title="Flickr"><i class="fa fa-flickr"></i></a></li>
                        <li><a href="<?php echo Yii::$app->params['youtube'] ?>" target="_blank"
                               title="Youtube"><i class="fa fa-youtube" style="background-color: #e62117;"></i></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="background-white p30 mt30 div">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.451124674305!2d30.04416431475501!3d-1.9737839985610413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca5c10212c65d%3A0x53f885c4f51cf0cd!2sRwanda+Guide!5e0!3m2!1sen!2srw!4v1480842595132"
                    width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="row">
                <h3>We’d love to hear from you</h3>

                <div class="contact-form-wrapper clearfix background-white p30 div">

                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <div class="form-group">
                        <label for="contact-form-name">Name</label>
                        <?= $form->field($model, 'name')->textInput(['id' => 'contact-form-name'])->label(false) ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-form-subject">Subject</label>
                        <?= $form->field($model, 'subject')->textInput(['id' => 'contact-form-subject'])->label(false) ?>
                    </div>

                    <div class="form-group">
                        <label for="contact-form-email">E-mail</label>
                        <?= $form->field($model, 'email')->textInput(['id' => 'contact-form-email'])->label(false) ?>
                    </div>
                    <div class="form-group">
                        <label for="contact-form-message">Message</label>
                        <?= $form->field($model, 'body')->textArea(['rows' => 6, 'id' => 'contact-form-message'])->label(false) ?>
                    </div>
                    <?= Html::submitButton(Html::tag('i ', ' Send Message', ['class' => 'fa fa-paper-plane']), ['class' => 'btn btn-primary pull-right', 'name' => 'contact-button']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

