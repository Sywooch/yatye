<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 13/02/2016
 * Time: 20:42
 * @var $this yii\web\View
 */

?>
<div class="cards-simple-wrapper">
    <div class="row">
        <?php if(!empty($place_list)): ?>
            <?php foreach ($place_list as $list): ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="card-simple" data-background-image="<?php echo Yii::$app->params['thumbnails'] . $list['logo'] ?>">
                        <div class="card-simple-background">
                            <div class="card-simple-content">
                                <h2><a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $list['place_slug'] ?>" target="_blank"><?php echo $list['place_name'] ?></a></h2>

                                <div class="card-simple-rating">
                                    <?php echo $list['street'] ?>
                                </div>

                                <div class="card-simple-actions">
                                    <a href="<?php echo Yii::$app->request->baseUrl . '/place-details/' . $list['place_slug'] ?>" target="_blank" class="fa fa-eye"></a>
                                </div>
                            </div>
                            <div class="card-simple-price" style="background-color: #c6af5c; opacity: 0.8;"><small><?php echo $list['service_name'] ?></small></div>

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
