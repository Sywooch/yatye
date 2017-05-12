<?php
/**
 * Created by PhpStorm.
 * User: ntezi
 * Date: 06/12/2016
 * Time: 16:15
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<?php if (!empty($model->getContact(Yii::$app->params['EMAIL']))): ?>
    <h2>Enquiry Form</h2>

    <div class="detail-enquire-form background-white p20 div">
        <?php $form = ActiveForm::begin(['action' => Yii::$app->request->baseUrl . '/place-details/contact/?id=' . $model->id]); ?>

        <?php if (!Yii::$app->user->isGuest) : ?>

            <?= $form->field($contact_form, 'name')->hiddenInput(['value' => Yii::$app->user->identity->username])->label(false) ?>
            <?= $form->field($contact_form, 'email')->hiddenInput(['value' => Yii::$app->user->identity->email])->label(false) ?>

        <?php else : ?>
            <div class="form-group">
                <label for=""><?php echo Yii::t('app', 'Name'); ?> <span class="required">*</span></label>
                <?= $form->field($contact_form, 'name')->textInput(['id' => 'contact-form-name'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for=""><?php echo Yii::t('app', 'Email'); ?> <span class="required">*</span></label>
                <?= $form->field($contact_form, 'email')->textInput(['id' => 'contact-form-email'])->label(false) ?>
            </div>
        <?php endif; ?>

        <div class="form-group">
            <label for=""><?php echo Yii::t('app', 'Subject'); ?> <span class="required">*</span></label>
            <?= $form->field($contact_form, 'subject')->textInput(['id' => 'contact-form-subject'])->label(false) ?>
        </div>

        <div class="form-group">
            <label for=""><?php echo Yii::t('app', 'Message'); ?> <span class="required">*</span></label>
            <?= $form->field($contact_form, 'body')->textArea(['rows' => 6, 'id' => 'contact-form-message'])->label(false) ?>
        </div>

        <p><?php echo Yii::t('app', 'Required fields are marked'); ?> <span class="required">*</span></p>
        <?= Html::submitButton(Html::tag('i ', Yii::t('app', 'Send'), ['class' => 'fa fa-paper-plane']), ['class' => 'btn btn-primary btn-block', 'name' => 'contact-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
<?php endif; ?>
