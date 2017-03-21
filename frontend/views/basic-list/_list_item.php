<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/07/2016
 * Time: 22:33
 */

use yii\helpers\Html;
use yii\helpers\Url;

$session = Yii::$app->session;
$category_id = $session->get('category_id');
?>
<div class="col-sm-6 col-lg-4 item" data-key="<?= $model->id ?>">
    <div class="card-simple" data-background-image="<?php echo $model->getThumbnailLogo() ?>">
        <div class="card-simple-background">
            <div class="card-simple-content">
                <h2>
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model->slug ?>" target="_blank"><?php echo $model->name ?></a>
                </h2>

                <div class="card-simple-rating">
                    <?php echo $model->getRatingStars() ?>
                </div>

                <div class="card-simple-actions">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model->slug ?>" target="_blank" class="fa fa-eye"></a>
                </div>
            </div>
            <div class="card-simple-label"><?php echo $model->getThisPlaceServiceName($category_id) ?></div>
            <div class="card-simple-price" style="opacity: 0.7"><small><?php echo $model->street ?></small></div>
        </div>
    </div>
</div>