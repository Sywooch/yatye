<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\widgets\ListView;

$this->title = Yii::$app->name . ' - ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['/category/' . $model->slug]];

$dataProvider->pagination = [
    'pageSize' => 24,
];
?>
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

