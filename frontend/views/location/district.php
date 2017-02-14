<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 23/07/2016
 * Time: 23:25
 */
use yii\helpers\Url;

$this->title = $model->name;
?>

<div class="container">
    <div class="block background-white p30 row">

        <div class="cards-wrapper">
            <div class="row">
                <?php if (!empty($service_categories)):
                    foreach ($service_categories as $category):
                        $logo = $category->getRandomPictures($category->id, $model->id);

                        if ($logo['logo'] != null): ?>
                            <div class="col-sm-4">
                                <div class="card" data-background-image="<?php echo Yii::$app->params['thumbnails'] . $logo['logo'] ?>">
                                    <div class="card-content">
                                        <h2><a href="<?php echo Url::to(['/category/' . $category->slug]) ?>"><?php echo $category->name ?></a></h2>
                                        <div class="card-actions">
                                            <a href="<?php echo Url::to(['/category/' . $category->slug]) ?>" class="fa fa-eye"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endif;
                    endforeach;
                endif; ?>
            </div>
        </div>

    </div>
</div>
