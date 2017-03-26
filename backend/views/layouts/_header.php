<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\helpers\Url;
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
                <div class="header-content">
                    <?php echo $this->render('@app/views/layouts/_header_content') ?>
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
                            <?php echo $this->render('@app/views/layouts/_header_statusbar_search') ?>
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