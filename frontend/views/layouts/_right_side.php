<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 14/02/2016
 * Time: 01:26
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="col-sm-4 col-lg-3 p30 visible-md visible-lg">
    <div class="sidebar" style="margin-top: -30px;">

        <?php
        $data = $this->context->accessData();
        $upcoming_events = $data['get_upcoming_events'];
        if (!empty($upcoming_events)): ?>
            <div class="widget">
                <h2 class="widgettitle"><?php echo Yii::t('app', 'Upcoming Events') ?></h2>
                <?php foreach ($upcoming_events as $upcoming_event): ?>
                    <div class="cards-small">
                        <div class="card-small">
                            <div class="card-small-image">
                                <a href="<?php echo Url::to(['/upcoming-event/' . $upcoming_event->slug]) ?>">
                                    <img class="img-responsive img-alt-thumbnail_tn"
                                         src="<?php echo $upcoming_event->getBanner(); ?>"
                                         alt="<?php echo $upcoming_event->name; ?>">
                                </a>

                            </div>

                            <div class="card-small-content">
                                <h3>
                                    <a href="<?php echo Url::to(['/upcoming-event/' . $upcoming_event->slug]) ?>">
                                        <?php echo $upcoming_event->name; ?></a>
                                </h3>
                                <h4>
                                    <a href="<?php echo Url::to(['/upcoming-event/' . $upcoming_event->slug]) ?>">
                                        <?php echo $upcoming_event->address; ?></a>
                                </h4>
                                <div class="card-small-price"><?php echo $upcoming_event->getDate();?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

<!--        <div class="widget">-->
<!--            <div class="row">-->
<!--                <img class="img-responsive div" src="http://placehold.it/260x400.png&text=Advertise Here" alt="Ads">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="widget">-->
<!--            <div class="row">-->
<!--                <img class="img-responsive div" src="http://placehold.it/260x400.png&text=Advertise Here" alt="Ads">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="widget">-->
<!--            <div class="row">-->
<!--                <img class="img-responsive div" src="http://placehold.it/260x400.png&text=Advertise Here" alt="Ads">-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <div class="widget">-->
<!--            <div class="row">-->
<!--                <img class="img-responsive div" src="http://placehold.it/260x400.png&text=Advertise Here" alt="Ads">-->
<!--            </div>-->
<!--        </div>-->

        <div class="widget">
            <h2 class="widgettitle"><?php echo Yii::t('app', 'Articles') ?></h2>
            <div class="row bootstrap snippet">
                <div class="div card-tab">
                    <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php

                        $data = $this->context->accessData();
                        $post_categories = $data['all_post_categories'];

                        if (!empty($post_categories)): ?>
                            <?php $in = ' in';
                            $tab = 'tab-';
                            foreach ($post_categories as $post_category): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading <?php echo $tab; ?>collapsed" role="tab"
                                         id="heading-<?php echo $post_category->slug; ?>">
                                        <h4 class="panel-title">
                                            <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse-<?php echo $post_category->slug; ?>" aria-expanded="true"
                                               aria-controls="collapse-<?php echo $post_category->slug; ?>">
                                                <?php echo $post_category->name; ?>
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-<?php echo $post_category->slug; ?>"
                                         class="panel-collapse collapse <?php /*echo $in; */ ?>" role="tabpanel"
                                         aria-labelledby="heading-<?php echo $post_category->slug; ?>"
                                         aria-expanded="true">
                                        <div class="panel-body">
                                            <?php
                                            $data_by_ids = $this->context->accessDataByIds($post_category->id);
                                            $posts = $data_by_ids['get_posts_by_post_category_id'];

                                            if (!empty($posts)):?>
                                                <ul class="menu">
                                                    <?php foreach ($posts as $post): ?>

                                                        <li>
                                                            <a href="<?php echo Url::to(['/post-details/' . $post->slug]) ?>"><?php echo $post->title ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $in = null;
                                $tab = null; endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="widget">
            <h2 class="widgettitle"><?php echo Yii::t('app', 'Directory') ?></h2>
            <div class="row bootstrap snippet">
                <div class="div">
                    <div class="panel-group drop-accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $data = $this->context->accessData();
                        $categories = $data['all_categories'];
                        if (!empty($categories)): ?>
                            <?php $in = ' in';
                            $tab = 'tab-';
                            foreach ($categories as $category): ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading <?php echo $tab; ?>collapsed" role="tab"
                                         id="heading-<?php echo $category->id; ?>">
                                        <h4 class="panel-title">
                                            <a class="collapse-controle" data-toggle="collapse" data-parent="#accordion"
                                               href="#collapse-<?php echo $category->id; ?>" aria-expanded="true"
                                               aria-controls="collapse-<?php echo $category->id; ?>">
                                                <?php echo $category->name; ?>
                                                <span class="expand-icon-wrap"><i class="fa expand-icon"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse-<?php echo $category->id; ?>"
                                         class="panel-collapse collapse <?php /*echo $in; */ ?>" role="tabpanel"
                                         aria-labelledby="heading-<?php echo $category->id; ?>" aria-expanded="true">
                                        <div class="panel-body">
                                            <?php $data = $this->context->accessDataByIds($category->id);
                                            $services = $data['get_services_by_category_id'];

                                            if (!empty($services)) : ?>
                                                <ul class="menu">
                                                    <?php foreach ($services as $service): ?>

                                                        <li>
                                                            <a href="<?php echo Url::to(['/service/' . $service->slug]) ?>"><?php echo $service->name ?></a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php $in = null;
                                $tab = null; endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="widget">
            <h2 class="widgettitle"><?php echo Yii::t('app', 'Youtube Playlist') ?></h2>
            <iframe width="256" height="200"
                    src="https://www.youtube-nocookie.com/embed/videoseries?list=PLvIBe6YqKnb1sZ_ShmbgxQX6W-ThTI4l5"
                    frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>
