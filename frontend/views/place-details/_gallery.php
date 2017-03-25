<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 9:04 PM
 */
?>

<div class="detail-gallery">
    <?php if ($model->logo != null) { ?>
        <div class="detail-gallery-preview">
            <a href="#">
                <img alt="<?php echo $model->name ?>"
                     src="<?php echo $model->getPhoto() ?>"
                     class="img-responsive img-alt">
            </a>
        </div>
    <?php } else { ?>
        <div class="detail-gallery-preview">
            <div class="cards-wrapper">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card"
                             data-background-image="<?php echo Yii::$app->params['pragmaticmates-logo-jpg'] ?>">
                            <div class="card-content">
                                <h2><a href="#"><?php echo $model->name ?></a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    if (!empty($photos)){ ?>
    <ul class="detail-gallery-index div">
        <?php foreach ($photos as $photo): ?>
            <li class="detail-gallery-list-item active">
                <a data-target="<?php echo Yii::$app->params['galleries'] . $photo->name ?>">
                    <img src="<?php echo Yii::$app->params['tn_thumbnails'] . $photo->name ?>"
                         alt="<?php echo $model->name ?>"
                         class="img-responsive img-alt-thumbnail_tn">
                </a>
            </li>
        <?php endforeach;
        } ?>
    </ul>
</div>
