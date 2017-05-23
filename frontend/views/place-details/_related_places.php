<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 3/25/17
 * Time: 9:14 PM
 */
/* @var $related_place backend\models\place\Place */
/* @var $service backend\models\place\Service */
use yii\helpers\Url;
use yii\widgets\ListView;
?>
<h2><?php echo Yii::t('app', 'You may also like'); ?></h2>
<hr>
<br>
<br>

<div class="block background-white p20 div">
    <div class="cards-simple-wrapper">
        <div class="row">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {

                    $itemContent = $this->render('_related_places_item',['model' => $model]);
                    return $itemContent;

                },
                'itemOptions' => [
                    'tag' => false,
                    'class' => 'item'
                ],

                'layout' => '{items}{pager}',

                'pager' => [
                    'prevPageLabel' => false,
                    'nextPageLabel' => false,
                    'maxButtonCount' => 4,
                    'options' => [
                        'class' => 'pager col-xs-12'
                    ]
                ],

            ]); ?>
        </div>
    </div>
</div>