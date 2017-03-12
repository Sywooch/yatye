<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\form\ActiveForm;
use kartik\widgets\Typeahead;
use yii\widgets\Breadcrumbs;

?>

<header class="header header-minimal">
    <div class="header-wrapper">
        <div class="container-fluid">
            <div class="header-inner">
                <div class="header-logo">
                    <a href="<?php echo Yii::$app->request->baseUrl; ?>/">
                        <img style="width: 128px;" src="<?= Yii::$app->params['logo_320'] ?>"
                             alt="<?php echo Yii::$app->name ?>" title="<?php echo Yii::$app->name ?>">
                    </a>
                </div>
                <div class=" header-content">
                        <div class="header-bottom">
                            <ul class="header-nav-primary nav nav-pills collapse navbar-collapse">
                                <?php if (Yii::$app->user->can('delete')) : ?>
                                    <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/user/admin/">User
                                            management</i></a></li>
                                    <li class="<?php echo preg_match('/customer-management/', $this->context->route, $matched) ? 'active' : '' ?>">
                                        <a href="<?php echo Yii::$app->request->baseUrl; ?>/customer-management/"
                                           title="Customer Management">Customer Management</a>
                                    </li>
                                <?php endif; ?>
                                <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/backup-restore">Backup
                                        Restore</i></a></li>
                            </ul>
                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse"
                                    data-target=".header-nav-primary">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="header-nav-user" style="margin-right: 80px">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span class="header-nav-user-name"><?= Yii::$app->user->identity->username ?></span>
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                        <li><a href="#">Edit Profile</a></li>
                                        <li><?= Html::a('Logout', ['/site/logout'], ['data-method' => 'post']) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-statusbar">
        <div class="header-statusbar-inner">
            <div class="header-statusbar-left">
                <h1>Dashboard</h1>

                <div class="display-inline-block">
                    <div class="hidden-xs visible-lg">
                        <div class="header-statusbar-search">

                            <?php if (
                                Yii::$app->controller->id != 'role'
                                && Yii::$app->controller->id != 'permission'
                                && Yii::$app->controller->id != 'admin'
                                && Yii::$app->controller->id != 'post'
                            ): ?>

                                <?php $data = $this->context->accessData();
                                $place_model = $data['place_model'];
                                $all_places = $data['get_all_places']; ?>

                                <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_INLINE, 'action' => Yii::$app->request->baseUrl . '/place']) ?>

                                <div class="form-group">
                                    <?php $place_names = array();
                                    foreach ($all_places as $place): array_push($place_names, $place->name); endforeach;

                                    echo $form->field($place_model, 'name')->widget(Typeahead::classname(), [
                                        'options' => ['placeholder' => 'Search by name', 'style' => ['width' => '300px'],],
                                        'pluginOptions' => ['highlight' => true,],
                                        'dataset' => [['local' => $place_names, 'limit' => 10],]
                                    ])->label(false); ?>
                                </div>
                                <div class="form-group">
                                    <?php echo Html::submitButton(Html::tag('span', '', ['class' => 'fa fa-search']), [
                                        'class' => ['btn btn-secondary btn-md', 'pull-right'],
                                        'style' => ['margin-left' => '-20px',],
                                    ]) ?>
                                </div>
                                <?php ActiveForm::end(); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-statusbar-right">
                <div class="hidden-xs visible-lg">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</header>