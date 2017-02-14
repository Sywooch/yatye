<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Enquiry */

$this->title = $model->subject;
?>
<div class="background-white p30">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label' => Yii::t('app', 'Place'),
                    'format' => 'raw',
                    'value' =>  Html::a($model->getPlaceName(), ['/settings', 'id' => $model->id], ['target' => '_blank']),
                ],
                'name',
                'email:email',
                'subject',
                'message:ntext',
                'created_at',
                'updated_at',
                'status',
//                'ip_address',
            ],
        ]) ?>
    </div>
</div>
