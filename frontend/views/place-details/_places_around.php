<?php
/**
 * Created by PhpStorm.
 * User: mariusngaboyamahina
 * Date: 5/10/17
 * Time: 4:51 PM
 */

use yii\helpers\Url;
use yii\widgets\ListView;
?>

<h2><?php echo Yii::t('app', 'Other Places Around'); ?></h2>
<div class="background-white p20 div">
    <div class="widget">
        <div class="row">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {

                    $itemContent = $this->render('_list_item',['model' => $model]);
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
                    'maxButtonCount' => 10,
                    'options' => [
                        'class' => 'pager col-xs-12'
                    ]
                ],

            ]); ?>
        </div>
    </div>

</div>
