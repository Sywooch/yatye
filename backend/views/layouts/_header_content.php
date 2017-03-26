<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/26/17
 * Time: 1:07 PM
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="header-bottom">
    <ul class="header-nav-primary nav nav-pills collapse navbar-collapse">
        <?php if (Yii::$app->user->can('delete')) : ?>
            <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/user/admin/">User management</i></a></li>
            <li class="<?php echo preg_match('/customer-management/', $this->context->route, $matched) ? 'active' : '' ?>">
                <a href="<?php echo Yii::$app->request->baseUrl; ?>/customer-management/" title="Customer Management">Customer Management</a>
            </li>
        <?php endif; ?>
        <li><a href="<?php echo Yii::$app->request->baseUrl; ?>/backup-restore">Backup Restore</i></a></li>
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
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
