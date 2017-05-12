<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/12/2016
 * Time: 16:16
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
?>

<?php if (!empty($comments)) : ?>
    <h2 id="reviews"><?php echo Yii::t('app', 'Reviews'); ?></h2>
    <?php foreach ($comments as $comment): ?>
        <div class="reviews background-white p20 mb30 div">
            <div class="review-title">
                <h2><?php echo $comment->full_name ?></h2>

                <div class="pull-right">
                    <?php echo date('D d M, Y',strtotime($comment->created_at)); ?>
                </div>
            </div>

            <div class="review-content">
                <p><?php echo $comment->comment ?></p>
            </div>
        </div>
    <?php endforeach; ?>
    <?= LinkPager::widget(['pagination' => $pagination]) ?>
<?php endif; ?>

<h2>Submit a Review</h2>

<div class="background-white p30 div">
    <?php $form = ActiveForm::begin(['action' => Yii::$app->request->baseUrl . '/place-details/comment/?id=' . $model->id]); ?>

    <div class="row">

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?= $form->field($review, 'full_name')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>
            <?= $form->field($review, 'email')->hiddenInput(['value' => Yii::$app->user->identity->email])->label(false) ?>

        <?php else : ?>
            <div class="form-group">
                <label for=""><?php echo Yii::t('app', 'Name'); ?> <span class="required">*</span></label>
                <?= $form->field($review, 'full_name')->textInput()->label(false) ?>
            </div>

            <div class="form-group">
                <label for=""><?php echo Yii::t('app', 'Email'); ?> <span class="required">*</span></label>
                <?= $form->field($review, 'email')->textInput()->label(false) ?>
            </div>
        <?php endif; ?>

    </div>

    <div class="row">
        <div class="form-group">
            <label for=""><?php echo Yii::t('app', 'Review'); ?> <span class="required">*</span></label>
            <?= $form->field($review, 'comment')->textArea(['rows' => 6])->label(false) ?>
        </div>

        <p>Required fields are marked <span class="required">*</span></p>
        <?= Html::submitButton(Html::tag('i ', Yii::t('app', 'Submit'), ['class' => 'fa fa-star']), ['class' => 'btn btn-primary btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
