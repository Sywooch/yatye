<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card-row div item" data-key="<?php echo $model['id'] ?>">
    <div class="card-row-inner">
        <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model['slug'] ?>">
            <div class="card-row-image" data-background-image="<?php echo ($model['logo'] != null) ? Yii::$app->params['galleries'] . $model->logo : Yii::$app->params['pragmaticmates-logo-jpg'] ?>"></div>
        </a>
        <div class="card-row-body">
            <h2 class="card-row-title"><a target="_blank" href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model['slug'] ?>"><?php echo $model['name'] ?></a></h2>
            <div class="card-row-content"></div>
        </div>
        <div class="card-row-properties" style="width: 360px;">
            <dl>
                <dd><?php echo Yii::t('app', 'Views') ?></dd>
                <dt><?php echo $model->getViews() ?></dt>
                <dd><?php echo Yii::t('app', 'Street') ?></dd>
                <dt><?php echo $model->street ?></dt>
                <dd><?php echo Yii::t('app', 'Neighborhood') ?></dd>
                <dt><?php echo $model->neighborhood ?></dt>
                <dd><?php echo Yii::t('app', 'Rating') ?></dd>
                <dt>
                <div class="card-row-rating">
                    <?php echo $model->getRatingStars() ?>
                </div>
                </dt>
            </dl>
        </div>
    </div>
</div>