<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = Yii::$app->name . ' - ' . $model->name;
$dataProvider->pagination = [
    'pageSize' => 6,
];
?>
<div class="container">
    <div class="row">
        <ol class="breadcrumb bread-primary" style="background: none;">
            <li><a href="<?php echo Url::to(['/category/' . $model->getCategorySlug()]) ?>"><?php echo $model->getCategoryName() ?></a></li>
            <li class="active"><a href="<?php echo Url::to(['/service/' . $model->slug]) ?>"><?php echo $model->name ?></a></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-sm-8 col-lg-9">
            <div class="content">

                <div class="cards-row">
                    <?= ListView::widget([
                        'options' => [
                            'tag' => 'div',
                        ],
                        'dataProvider' => $dataProvider,
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_list_item', ['model' => $model]);

                        },
                        'itemOptions' => [
                            'tag' => false,
                            'class' => 'item'
                        ],

                        /* do not display {summary} */
                        'layout' => '{items}{pager}',

                        'pager' => [
                            'prevPageLabel' => 'Prev',
                            'nextPageLabel' => 'Next',
                            'maxButtonCount' => 12,
                            'options' => [
                                'class' => 'pager col-xs-12'
                            ]
                        ],

                    ]); ?>
                </div>
            </div>
        </div>
        <?php echo $this->render('@app/views/layouts/_right_side') ?>
    </div>
</div>
