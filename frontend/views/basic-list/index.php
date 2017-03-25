<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::$app->name . ' - ' . $model->name;

$dataProvider->pagination = [
    'pageSize' => 24,
];
$category = $model;
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
                <div class="cards-simple-wrapper div p30">
                    <div class="row">
                        <?= ListView::widget([
                            'options' => [
                                'tag' => 'div',
                            ],
                            'dataProvider' => $dataProvider,
                            'itemView' => function ($model, $key, $index, $widget) {


                                $itemContent = $this->render('_list_item',['model' => $model]);

                                /* Display an Advertisement after the first list item */
//                                if ($index == 0) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }
//
//                                if ($index == 5) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }
//
//                                if ($index == 10) {
//                                    $adContent = $this->render('_ad');
//                                    $itemContent .= $adContent;
//                                }

                                return $itemContent;

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
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>

