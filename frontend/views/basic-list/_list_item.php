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
<div class="col-sm-6 col-lg-4 item" data-key="<?= $model->id ?>">
    <div class="card-simple" data-background-image="<?php echo $model->getThumbnailLogo() ?>">
        <div class="card-simple-background">
            <div class="card-simple-content">
                <h2>
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model->slug ?>" target="_blank"><?php echo $model->name ?></a>
                </h2>

                <div class="card-simple-rating">
                    <?php echo $model->street ?>
                </div>

                <div class="card-simple-actions">
                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $model->slug ?>" target="_blank" class="fa fa-eye"></a>
                </div>
            </div>
            <div class="card-simple-price" style="background-color: #c6af5c; opacity: 0.8;">
                <small></small>
            </div>
        </div>
    </div>
</div>