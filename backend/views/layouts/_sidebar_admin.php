<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="sidebar-admin">
    <ul>
        <li class="<?php echo preg_match('/site/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/about-us/" title="About us" >
                <i class="fa fa-comments"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/service/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/service/" title="Services">
                <i class="fa fa-list"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/event-tags/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/event-tags/" title="Event Tags">
                <i class="fa fa-tags"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/post-category/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/post-category/" title="Post Category">
                <i class="fa fa-adjust"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/subscription/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/subscription/" title="Subscriptions">
                <i class="fa fa-rss"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/news-letter/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/news-letter/" title="News Letter">
                <i class="fa fa-bullhorn"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/pricing/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/pricing/" title="Pricing">
                <i class="fa fa-money"></i>
            </a>
        </li>
        <li class="<?php echo preg_match('/gallery/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a data-toggle="tooltip" href="<?php echo Yii::$app->request->baseUrl; ?>/gallery/" title="Gallery">
                <i class="fa fa-photo"></i>
            </a>
        </li>
    </ul>
</div>
<div class="sidebar-secondary-admin">
    <ul>
        <li class="<?php echo preg_match('/site/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/site/">
                <span class="icon"><i class="fa fa-tachometer"></i></span>
                <span class="title">Dashboard
                </span>
                <span class="subtitle">Dashboard</span>
            </a>
        </li>
        <li class="<?php echo preg_match('/place/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/place/">
                <span class="icon"><i class="fa fa-industry"></i></span>
                <span class="title">Places
                </span>
                <span class="subtitle">Place Management</span>
            </a>
        </li>
        <li class="<?php echo preg_match('/event/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/event/">
                <span class="icon"><i class="fa fa-calendar"></i></span>
                <span class="title">Event
                </span>
                <span class="subtitle">Event Management</span>
            </a>
        </li>
        <li class="<?php echo preg_match('/post/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/post/">
                <span class="icon"><i class="fa fa-newspaper-o"></i></span>
                <span class="title">Posts
                </span>
                <span class="subtitle">Post Management</span>
            </a>
        </li>

        <li class="<?php echo preg_match('/views/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/views/">
                <span class="icon"><i class="fa fa-eye"></i></span>
                <span class="title">Views
                </span>
                <span class="subtitle">Views Management</span>
            </a>
        </li>
        <li class="<?php echo preg_match('/enquiry/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/enquiry/">
                <span class="icon"><i class="fa fa-question"></i></span>
                <span class="title">Enquiries</span>
                <span class="subtitle">Enquiry management</span>
            </a>
        </li>
        <li class="<?php echo preg_match('/ads/', $this->context->route, $matched) ? 'active' : '' ?>">
            <a href="<?php echo Yii::$app->request->baseUrl; ?>/ads/">
                <span class="icon"><i class="fa fa-magic"></i></span>
                <span class="title">Ads
                </span>
                <span class="subtitle">Ads Management</span>
            </a>
        </li>
    </ul>
</div>