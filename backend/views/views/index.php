<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Views';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-white p20 mb50">
    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    <div class="row">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'showFooter' => true,
            'showHeader' => true,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label' => 'Name',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a($model['name'], ['list', 'id' => $model['id']]);
                    },
                ],
                'views',
                [
                    'label' => 'Time',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return date('D j M  G:i T Y', strtotime($model['updated_at']));
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{status}',
                    'buttons' => [
                        'status' => function ($url, $model) {
                            return Html::a(Html::tag('i', '', ['class' => ($model['status'] == Yii::$app->params['inactive']) ? 'fa fa-check' : 'fa fa-times']), Yii::$app->request->baseUrl . '/views/status/?id=' . $model['id'], [
                                'class' => 'btn btn-primary btn-xs',
                            ]);
                        },
                    ],
                ],
            ],

            'tableOptions' => ['class' => 'table mb0'],
        ]); ?>
    </div>
</div>
