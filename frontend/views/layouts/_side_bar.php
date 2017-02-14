<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/03/2016
 * Time: 16:58
 */
use yii\helpers\Url;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\base\View;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

?>
<div class="col-sm-4 col-lg-3">
    <div class="sidebar">

        <?php

        if ($data['all_categories']) : ?>
            <?= $this->render('@app/views/user-profile/_profile-picture', ['model' => $data['profile_picture'], 'data' => $data]) ?>
        <?php endIf; ?>
        <div class="widget div">

            <ul class="menu-advanced">
                <li class="<?php echo strpos(Yii::$app->request->getUrl(), '/dashboard/') ? 'active' : '' ?>">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/dashboard/' ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                </li>
                <li class="<?php echo strpos(Yii::$app->request->getUrl(), '/user-profile/') ? 'active' : '' ?>">
                    <a href="<?php echo Url::to(['/user-profile/view']) ?>"><i class="fa fa-user"></i> My Profile</a>
                </li>
                <!--<li class="<?php /*echo strpos(Yii::$app->request->getUrl(), '/my-blog/') ? 'active' : '' */?>">
                    <a href="<?php /*echo Yii::$app->request->baseUrl . '/my-blog/' */?>"><i class="fa fa-bars"></i> My Blogs</a>
                </li>-->
                <li class="<?php echo strpos(Yii::$app->request->getUrl(), '/place/') ? 'active' : '' ?>">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place/' ?>"><i class="fa fa-list"></i> My Places</a>
                </li>
                <li class="<?php echo strpos(Yii::$app->request->getUrl(), '/event/') ? 'active' : '' ?>">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/event/' ?>"><i class="fa fa-calendar"></i> My Events</a>
                </li>

                <!--<li class="<?php /*echo strpos(Yii::$app->request->getUrl(), '/user/recovery/reset/') ? 'active' : '' */?>">
                    <a href="<?php /*echo Yii::$app->request->baseUrl . '//user/recovery/reset' */?>"><i class="fa fa-key"></i> Reset Password</a>
                </li>-->
                <li>
                    <a href="<?php echo Url::to(['/user/security/logout']) ?>" data-method="post"><i
                            class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>

    </div>
</div>
