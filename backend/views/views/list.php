<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 29/05/2016
 * Time: 02:34
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'View List';
$this->params['breadcrumbs'][] = ['label' => 'Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="background-white p30 mb50">
    <h4 class="page-title">
        <?= Html::encode($this->title) ?>
        <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-arrow-left']), ['/views'], ['class' => 'btn btn-primary btn-xs pull-right']) ?>
    </h4>

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

