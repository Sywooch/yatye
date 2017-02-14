<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = Yii::$app->name . ' - ' . $model->name;

$dataProvider->pagination = [
    'pageSize' => 12,
];
?>

<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Yii::$app->request->baseUrl ?>"><?php echo Yii::$app->name; ?></a></li>
            <li class="active"><a
                    href="<?php echo Url::to(['/category/' . $model->slug]) ?>"><?php echo $model->name ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">
                <div class="cards-simple-wrapper">
                    <div class="row">
                        <?php Pjax::begin([
                            'enablePushState' => false,
                            'enableReplaceState' => false
                        ]); ?>
                        <?= ListView::widget([
                            'options' => [
                                'tag' => 'div',
                            ],
                            'dataProvider' => $dataProvider,
                            'itemView' => function ($model, $key, $index, $widget) {
                                return $this->render('_list_item', ['model' => $model]);


//                                $itemContent = $this->render('_list_item',['model' => $model]);
//
//                                /* Display an Advertisement after the first list item */
//                                if ($index == 2) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }
//
//                                return $itemContent;

                            },
                            'itemOptions' => [
                                'tag' => false,
                                'class' => 'item'
                            ],
//                            'pager' => [
//                                'class' => ScrollPager::className(),
//                                'delay' => 300,
//                            ],
//                            'summary' => '',
                            /* do not display {summary} */
                            'layout' => '{items}{pager}',

                            'pager' => [
//                                'firstPageLabel' => 'First',
//                                'lastPageLabel' => 'Last',
                                'prevPageLabel' => 'Prev',
                                'nextPageLabel' => 'Next',
                                'maxButtonCount' => 12,
                                'options' => [
                                    'class' => 'pager col-xs-12'
                                ]
                            ],

                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>


                <!--                --><?php //echo $this->render('/list/_basic_list', [
                //                    'model' => $model,
                //                    'place_list' => $place_list,
                //                ]); ?>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>

