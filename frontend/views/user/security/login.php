<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\RwandaguideAsset;

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */
RwandaguideAsset::register($this);
$this->title = Yii::t('user', 'Login in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="background-white p30 text-justify div">
                <h4>About Contribute</h4>
                <p>We are actively looking for inspiring testimonies, articles, and new places, which will help people who are coming or planning visit Rwanda.</p>
                <p>We appreciate your interest in improving the visibility of the country of thousand hills</p>
                <p>Your contribution will help this application to become a well-populated resource for visitors.
                    We welcome your contribution for sharing new places as well as posts.</p>
                <p>The simplest way to get involved is to try out the tools featured here.
                    Let us know what works, and what not. Share your experience in Rwanda, by adding new places with images or leave a testimony. We want these examples to be relevant and useful for other people who have never been to Rwanda.</p>
                <p>We trust you to contribute positively. We are being as open as possible. However, if you are found to be abusing the system, or your contributions are not helpful (or relevant) we reserve the right to not publish these posts.</p>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
            <div class="background-white p15 mb30 text-justify div">
                <h4>Login<small> to contribute</small></h4>
                <p>Please read <a href="http://rwandaguide.info/about-us/terms-conditions">Terms & Conditions</a> and
                    <a href="http://rwandaguide.info/about-us/privacy-policy">Privacy Policy</a> before creating account.</p>
            </div>
            <div class="omb_login">
                <div class="row omb_row-sm-offset-3 omb_socialButtons">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a href="<?php echo Yii::$app->request->baseUrl . '/user/security/auth?authclient=facebook'; ?>"
                           class="btn btn-xs btn-block omb_btn-facebook" target="_blank">
                            <i class="fa fa-facebook visible-xs"></i>
                            <span class="hidden-xs">Facebook</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a href="<?php echo Yii::$app->request->baseUrl . '/user/security/auth?authclient=twitter'; ?>"
                           class="btn btn-xs btn-block omb_btn-twitter" target="_blank">
                            <i class="fa fa-twitter visible-xs"></i>
                            <span class="hidden-xs">Twitter</span>
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <a href="<?php echo Yii::$app->request->baseUrl . '/user/security/auth?authclient=google'; ?>"
                           class="btn btn-xs btn-block omb_btn-google" target="_blank">
                            <i class="fa fa-google-plus visible-xs"></i>
                            <span class="hidden-xs">Google+</span>
                        </a>
                    </div>
                    <!--<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <a href="<?php /*echo Yii::$app->request->baseUrl . '/user/security/auth?authclient=linkedin'; */ ?>" class="btn btn-xs btn-block omb_btn-linkedin" target="_blank">
                        <i class="fa fa-linkedin visible-xs"></i>
                        <span class="hidden-xs">Linkedin</span>
                    </a>
                </div>-->
                </div>

                <div class="row omb_row-sm-offset-3 omb_loginOr">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <hr class="omb_hrOr">
                        <span class="omb_spanOr div">or</span>
                    </div>
                </div>

                <div class="background-white p20 div">
                    <div class="row omb_row-sm-offset-3">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'enableAjaxValidation' => true,
                                'enableClientValidation' => false,
                                'validateOnBlur' => false,
                                'validateOnType' => false,
                                'validateOnChange' => false,
                            ]) ?>
                            <div class="form-group">
                                <label for="login-form-email">E-mail or Username</label>
                                <!--                        <span class="input-group-addon"><i class="fa fa-user"></i></span>-->
                                <?= $form->field($model, 'login', ['inputOptions' => [
                                    'autofocus' => 'autofocus',
                                    'class' => 'form-control',
                                    'id' => 'login-form-password',
                                    'tabindex' => '1'
                                ]])->label(false) ?>
                            </div>
                            <span class="help-block"></span>

                            <div class="form-group">
                                <label for="login-form-password">Password</label>
                                <!--                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>-->
                                <?= $form->field($model, 'password', ['inputOptions' => [
                                    'class' => 'form-control',
                                    'id' => 'login-form-email',
                                    'tabindex' => '2']
                                ])
                                    ->passwordInput()
                                    ->label(Yii::t('user', 'Password') . ($module->enablePasswordRecovery ? ' (' . Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')' : ''))
                                    ->label(false) ?>
                            </div>
                            <?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary btn-block', 'tabindex' => '3']) ?>
                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                    <div class="row omb_row-sm-offset-3">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <!--<label class="checkbox">
                                <input type="checkbox" value="remember-me">Remember Me
                            </label>-->
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <p class="omb_forgotPwd">
                                <?php echo $module->enablePasswordRecovery ? Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) : '' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
