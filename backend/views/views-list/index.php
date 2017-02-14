<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = 'Views Details';
?>
<div class="background-white p30 mb50">
    <h4 class="page-title"><?= Html::encode($this->title) ?></h4>
    <div class="row">
        <div class="col-sm-12">
            <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-left']), Yii::$app->request->baseUrl . '/views', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <div class="row">
        <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'ip_address',
                [
                    'attribute' => 'created_at',
                    'label' => Yii::t('app', 'Time'),
                    'value' => function ($model) {
                        return date('D j M  G:i T Y', strtotime($model->created_at));
                    },
                ]
            ]
        ]); ?>
    </div>
</div>
