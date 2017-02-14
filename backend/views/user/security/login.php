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

/**
 * @var yii\web\View                   $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module           $module
 */

$this->title =  Yii::$app->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validateOnBlur' => false,
    'validateOnType' => false,
    'validateOnChange' => false,
]) ?>
<div class="form-group">
    <label for="login-form-email">E-mail</label>
    <?= $form->field($model, 'login', ['inputOptions' => [
        'autofocus' => 'autofocus',
        'class' => 'form-control',
        'id' => 'login-form-password',
        'tabindex' => '1'
    ]])->label(false) ?>
</div>

<div class="form-group">
    <?= $form->field($model, 'password', ['inputOptions' => [
        'class' => 'form-control',
        'id' => 'login-form-email',
        'tabindex' => '2']
    ])
        ->passwordInput()
        ->label(Yii::t('user', 'Password') . ($module->enablePasswordRecovery ? ' (' . Html::a(Yii::t('user', 'Forgot password?'), ['/user/recovery/request'], ['tabindex' => '5']) . ')' : '')) ?>
</div>
<?= Html::submitButton(Yii::t('user', 'Login'), ['class' => 'btn btn-primary btn-block pull-right', 'tabindex' => '3']) ?>
<?php ActiveForm::end(); ?>

