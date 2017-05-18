<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = $model->name . ' in Rwanda';
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/category/' . $model->slug]];

?>
<div class="col-sm-8 col-lg-9">
    <div class="content">
        <div class="cards-row p20">
            <div class="row">
                <?= ListView::widget([
                    'options' => [
                        'tag' => 'div',
                    ],
                    'dataProvider' => $dataProvider,
                    'itemView' => function ($model, $key, $index, $widget) {
//                                return $this->render('_list_item', ['model' => $model]);
                        $itemContent = $this->render('_list_item',['model' => $model]);

                        /* Display an Advertisement after the first list item */
//                                if ($index == 2) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }
//
//                                if ($index == 5) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }
//
//                                if ($index == 8) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }

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
        </div>
    </div>
</div>
<?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>

