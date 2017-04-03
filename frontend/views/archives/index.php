<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Archives';
$this->params['breadcrumbs'][] = $this->title;

$dataProvider->pagination = [
    'pageSize' => 6,
];
?>
<div class="col-sm-8 col-lg-9">
    <div class="content">
        <div class="page-title">
            <h1><?php echo $this->title; ?></h1>
        </div>
        <div class="posts">
            <?= ListView::widget([
                'options' => [
                    'tag' => 'div',
                ],
                'dataProvider' => $dataProvider,
                'itemView' => function ($model, $key, $index, $widget) {


                    $itemContent = $this->render('_list_item',['model' => $model]);

                    /* Display an Advertisement after the first list item */
                    /*if ($index == 5) {
                        $adContent = $this->render('_ad');
                        $itemContent .= $adContent;
                    }*/

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
                    'maxButtonCount' => 12,
                    'options' => [
                        'class' => 'pager col-xs-12'
                    ]
                ],

            ]); ?>

        </div>
    </div>
</div>
<?= $this->render('@app/views/layouts/right-side/_right_side', []) ?>
