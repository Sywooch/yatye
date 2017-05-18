<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:20
 */
/* @var $most_viewed backend\models\place\Place */
/* @var $recent_added_place backend\models\place\Place */
/* @var $service backend\models\place\Service */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="card-tab">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#viewed" aria-controls="viewed" role="tab" data-toggle="tab"><?php echo Yii::t('app', 'Most Viewed') ?></a>
        </li>
        <li role="presentation">
            <a href="#recent" aria-controls="recent" role="tab" data-toggle="tab"><?php echo Yii::t('app', 'New Places') ?></a>
        </li>
        <li role="presentation">
            <a href="#categories" aria-controls="categories" role="tab" data-toggle="tab"><?php echo Yii::t('app', 'Categories') ?></a>
        </li>

    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="viewed">
            <div class="sidebar">
                <?php if (!empty($get_most_viewed)): ?>
                    <div class="widget">
                        <ul class="menu">
                            <?php foreach ($get_most_viewed as $most_viewed): ?>
                                <li>
                                    <a href="<?php echo $most_viewed->getPlaceUrl() ?>"
                                       target="_blank"><?php echo $most_viewed->name ?>
                                        <strong><?php echo $most_viewed->getViews() ?></strong>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="categories">
            <?php if (!empty($services)): ?>
                <div class="widget">
                    <ul class="menu">
                        <?php foreach ($services as $service): ?>

                            <li>
                                <a href="<?php echo $service->getUrl() ?>"><?php echo $service->name ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
        <div role="tabpanel" class="tab-pane" id="recent">
            <?php if (!empty($recent_added_places)): ?>
                <div class="widget">
                    <ul class="menu">
                        <?php foreach ($recent_added_places as $recent_added_place): ?>

                            <li>
                                <a href="<?php echo $recent_added_place->getPlaceUrl() ?>"
                                   target="_blank"><?php echo $recent_added_place->name ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>