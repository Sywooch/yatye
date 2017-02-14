<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\NewsLetter */

$this->title = $model->subject;
?>
<div class="background-white p20 mb50">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (($model['status'] == Yii::$app->params['draft'])) : ?>
            <?= Html::a(Html::tag('i', Yii::t('app', ' Send'), ['class' => 'fa fa-send']), Yii::$app->request->baseUrl . '/news-letter/send/?id=' . $model->id, ['class' => 'btn btn-primary btn-xs']) ?>
            <?= Html::a(Html::tag('i', Yii::t('app', ' Update'), ['class' => 'fa fa-edit']), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']) ?>
        <?php endif; ?>

        <?= Html::a(Html::tag('i', Yii::t('app', ' Delete'), ['class' => 'fa fa-trash']), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-xs',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject',
            'message:ntext',
            'type',
            'send_at',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'attachment',
            'status',
        ],
    ]) ?>

</div>
