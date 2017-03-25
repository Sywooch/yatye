<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 9:14 PM
 */
?>
<h2>You may also like</h2>
<div class="cards-simple-wrapper">
    <div class="row">

        <?php foreach ($related_places as $related_place): ?>
            <div class="col-sm-6 col-lg-3">
                <div class="card-simple" data-background-image="<?php echo $related_place->getThumbnailLogo() ?>">
                    <div class="card-simple-background">
                        <div class="card-simple-content">
                            <h2>
                                <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $related_place->slug ?>" target="_blank">
                                    <?php echo $related_place->name ?>
                                </a>
                            </h2>

                            <div class="card-simple-rating">
                                <?php echo $related_place->getRatingStars() ?>
                            </div>

                            <div class="card-simple-actions">
                                <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $related_place->slug ?>" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-simple-label" style="opacity: 0.7">
                            <small><?php echo $related_place->street ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
