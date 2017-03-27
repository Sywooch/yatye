<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 01/01/2016
 * Time: 22:21
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\rating\StarRating;

?>
<div class="faq-rating-form">

    <?php $form = ActiveForm::begin(['method' => 'post', 'action' => ['/ratings/rate', 'place_id' => $model->id],]); ?>

    <?= $form->field($ratings, 'ratings')->label(false)->widget(StarRating::classname(), [
        'pluginOptions' => [
            'size' => 'xs',
            'stars' => 5,
            'min' => 0,
            'max' => 5,
            'step' => 0.5,
            'starCaptions' => []
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-xs']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>
