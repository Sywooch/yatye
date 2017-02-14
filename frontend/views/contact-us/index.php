<?php
/* @var $this yii\web\View */

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('app', 'Contact');
?>
<div class="container">
    <div class="background-white p30 mb30 div">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3987.451124674305!2d30.04416431475501!3d-1.9737839985610413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca5c10212c65d%3A0x53f885c4f51cf0cd!2sRwanda+Guide!5e0!3m2!1sen!2srw!4v1480842595132" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="contact-form-wrapper clearfix background-white p30 div">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <div class="form-group">
                    <label for="contact-form-name"><?php echo Yii::t('app', 'Name') ?></label>
                    <?php echo $form->field($model, 'name')->textInput(['id' => 'contact-form-name'])->label(false) ?>
                </div>

                <div class="form-group">
                    <label for="contact-form-subject"><?php echo Yii::t('app', 'Subject') ?></label>
                    <?php echo $form->field($model, 'subject')->textInput(['id' => 'contact-form-subject'])->label(false) ?>
                </div>

                <div class="form-group">
                    <label for="contact-form-email"><?php echo Yii::t('app', 'E-mail') ?></label>
                    <?php echo $form->field($model, 'email')->textInput(['id' => 'contact-form-email'])->label(false) ?>
                </div>
                <div class="form-group">
                    <label for="contact-form-message"><?php echo Yii::t('app', 'Message') ?></label>
                    <?php echo $form->field($model, 'body')->textArea(['rows' => 6, 'id' => 'contact-form-message'])->label(false) ?>
                </div>
                <?php echo Html::submitButton(Html::tag('i ', ' Send Message', ['class' => 'fa fa-paper-plane']), ['class' => 'btn btn-primary pull-right', 'name' => 'contact-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="col-sm-6">
            <h3><?php echo Yii::t('app', 'We’d love to hear from you') ?></h3>

            <div class="row">
                <div class="col-sm-6">
                    <h3><?php echo Yii::t('app', 'Address') ?></h3>
                    <p>
                        KN 185 St, Kigali<br>
                        Nyakabanda Nyarugenge
                    </p>
                </div>

                <div class="col-sm-6">
                    <h3><?php echo Yii::t('app', 'Contacts') ?></h3>
                    <p>
                        <i class="fa fa-mobile-phone"></i> +250788590179<br>
                        <i class="fa fa-envelope-o"></i> <a href="mailto:">rwandaguide@rwandaguide.info</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>