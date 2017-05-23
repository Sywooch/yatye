<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:04
 */
/* @var $free_place backend\models\place\Place */
/* @var $service backend\models\place\Service */
/* @var $model backend\models\place\Category */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>
<?php if (!empty($free_places)): ?>
<div class="block background-white mt30 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Most Recent Places') ?></h1>

        <p><?php echo Yii::t('app', 'List of most recent interesting places in our directory.') ?></p>
    </div>
    <div class="cards-simple-wrapper">
        <div id="basic-list" class="row">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {


                    $itemContent = $this->render('_free_item', ['model' => $model]);

                    /* Display an Advertisement after the first list item */
//                        if ($index == 0) {
//                            $adContent = $this->render('_ad');
//                            $itemContent .= $adContent;
//                        }
                    return $itemContent;

                },
                'itemOptions' => [
                    'tag' => false,
                    'class' => 'item'
                ],
                'layout' => '{items}',

            ]); ?>
        </div>
        <?php if (count($free_places) >= 16) : ?>
            <div class="row">
                <div
                        class="col-xs-12 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
                    <a href="<?php echo Url::to(['/basic-list/' . $model->slug]) ?>"
                       class="btn btn-secondary btn-md btn-block"><?php echo Yii::t('app', 'View All') ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>