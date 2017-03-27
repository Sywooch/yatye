<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::$app->name . ' - Filter';

?>
<div class="mt50">
    <div class="col-sm-8 col-lg-9">
        <div class="content">

            <?= $this->render('_filter', [
                'params' => $params,
                'model' => $model,
                'provinces' => $provinces,
                'categories' => $categories,
            ]) ?>

            <div class="cards-row">
                <?= ListView::widget([
                    'options' => [
                        'tag' => 'div',
                    ],
                    'dataProvider' => $dataProvider,
                    'emptyText' => 'There are no results that match your filter!',
                    'emptyTextOptions' => [
                        'class' => 'alert alert-warning text-center',
                        'style' => 'font-size:20px;background-color: #5d4a43;border-color: #5d4a43;',
                    ],
                    'itemView' => function ($model, $key, $index, $widget) {


                        $itemContent = $this->render('_list_item', ['model' => $model]);

                        /* Display an Advertisement after the first list item */
//                            if ($index == 0) {
//                                $adContent = $this->render('_ad');
//                                $itemContent .= $adContent;
//                            }
//
//                            if ($index == 5) {
//                                $adContent = $this->render('_ad');
//                                $itemContent .= $adContent;
//                            }
//
//                            if ($index == 10) {
//                                $adContent = $this->render('_ad');
//                                $itemContent .= $adContent;
//                            }

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
                            'class' => 'pager'
                        ]
                    ],

                ]); ?>
            </div>

        </div>
    </div>
    <?php echo $this->render('@app/views/layouts/_right_side') ?>
</div>

