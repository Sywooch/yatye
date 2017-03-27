<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */

$this->title = $model->getPlaceName() . ' - ' . $model->getServiceName();
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Galleries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="background-white p20 mb50">
    <div class="row">
        <div class="col-sm-12">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'place_id',
                    'service_id',
                    'title',
                    'caption',
                    'expire_at',
                    [
                        'attribute' => 'status',
                        'label' => Yii::t('app', 'Status'),
                        'value' => function ($model) {
                            return $model->getStatus();
                        },
                    ],
                    [
                        'attribute' => 'created_by',
                        'label' => Yii::t('app', 'Created By'),
                        'value' => function ($model) {
                            return $model->getUser();
                        },
                    ],
                    [
                        'attribute' => 'updated_by',
                        'label' => Yii::t('app', 'Updated By'),
                        'value' => function ($model) {
                            return $model->getUser();
                        },
                    ],
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <?php echo FileInput::widget([
            'name' => 'mediafile',
            'buttonTag' => 'button',
            'buttonName' => 'Browse',
            'buttonOptions' => ['class' => 'btn btn-default'],
            'options' => ['class' => 'form-control'],
            // Widget template
            'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            // Optional, if set, only this image can be selected by user
            'thumb' => 'original',
            // Optional, if set, in container will be inserted selected image
            'imageContainer' => '.img',
            // Default to FileInput::DATA_IDL. This data will be inserted in input field
            'pasteData' => FileInput::DATA_ID,
            // JavaScript function, which will be called before insert file data to input.
            // Argument data contains file data.
            // data example: [alt: "Ведьма с кошкой", description: "123", url: "/uploads/2014/12/vedma-100x100.jpeg", id: "45"]
            'callbackBeforeInsert' => 'function(e, data) {
        console.log( data );
    }',
        ]); ?>
    </div>
</div>

