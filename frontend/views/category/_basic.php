<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 25/12/2016
 * Time: 21:05
 */
/* @var $basic_place backend\models\place\Place */
/* @var $service backend\models\place\Service */
/* @var $model backend\models\place\Category */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

?>

<div class="block background-white mt30 p30 row div">
    <div class="page-header">
        <h1><?php echo Yii::t('app', 'Hand Picked by Rwanda Guide') ?></h1>

        <p><?php echo Yii::t('app', 'Check out the best places. Each one is worth of visiting. Experience which you will never forget.') ?></p>
    </div>
    <div class="cards-wrapper">
        <div class="row">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {


                    $itemContent = $this->render('_basic_item', ['model' => $model]);

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
                /* do not display {summary} */
                'layout' => '{items}{pager}',

                'pager' => [
                    'prevPageLabel' => false,
                    'nextPageLabel' => false,
                    'maxButtonCount' => 10,
                    'options' => [
                        'class' => 'pager col-xs-12'
                    ]
                ],

            ]); ?>
        </div>
        <?php if (count($basic_places) >= 6) : ?>
            <div class="row">
                <div class="col-xs-12 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5 col-lg-2 col-lg-offset-5">
                    <a href="<?php echo Url::to(['/premium-list/' . $model->slug]) ?>"
                       class="btn btn-secondary btn-md btn-block"><?php echo Yii::t('app', 'View All') ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>