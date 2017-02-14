<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/02/2016
 * Time: 20:42
 * @var $this yii\web\View
 */

use yii\widgets\LinkPager;

?>
<div class="cards-simple-wrapper">
    <div class="row">
        <?php if(!empty($services)): ?>
            <?php foreach ($services as $service): ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="card-simple" data-background-image="<?php echo Yii::$app->params['thumbnails'] . $service['logo'] ?>">
                        <div class="card-simple-background">
                            <div class="card-simple-content">
                                <h2><a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $service['place_slug'] ?>" target="_blank"><?php echo $service['place_name'] ?></a></h2>

                                <div class="card-simple-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>

                                <div class="card-simple-actions">
                                    <a href="#" class="fa fa-eye"></a>
                                </div>
                            </div>
                            <div class="card-simple-price" style="background-color: #c6af5c; opacity: 0.5;"><?php echo $service['street'] ?></div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Welcome to Rwanda Guide! </strong><?php echo Yii::$app->params['missing_message']; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="pager">
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
