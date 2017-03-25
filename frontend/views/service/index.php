<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
$this->title = Yii::$app->name . ' - ' . $model->name;
$dataProvider->pagination = [
    'pageSize' => 12,
];
?>
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

<?php echo $this->render('@app/views/layouts/_right_side') ?>
