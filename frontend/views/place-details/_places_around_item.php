<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */
/* @var $model backend\models\place\Place */
/* @var $service backend\models\place\Service */
use yii\helpers\Html;
use yii\helpers\Url;

$service = $model->getThisPlaceHasService()
?>
<div class="col-sm-6 item" data-key="<?= $model->id ?>">
    <div class="cards-small">
        <div class="card-small">
            <div class="card-small-image">
                <a href="listing-detail.html">
                    <img class="img-responsive img-alt-thumbnail_tn"
                         src="<?php echo $model->getThumbnailLogo(); ?>"
                         alt="<?php echo $model->name ?>" style="width: 80px; height: 67px;">
                </a>
            </div>

            <div class="card-small-content">
                <h3>
                    <a href="<?php echo Url::to(['/place-details/' . $model->slug]) ?>"
                       target="_blank"><?php echo $model->name ?></a>
                </h3>
                <h4>
                    <a target="_blank" href="<?php echo $service->getUrl() ?>">
                        <span class="badge" style="background-color: #c6af5c; font-size: 10px;">
                            <?php echo $service->name ?>
                        </span>
                    </a><br>
                    <a target="_blank" href="<?php echo Url::to(['/place-details/' . $model->slug]) ?>">
                        <?php echo $model->neighborhood . '/' . $model->street ?>
                    </a>
                </h4>
            </div>
        </div>
    </div>
</div>

